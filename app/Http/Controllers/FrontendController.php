<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\TicketType;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FrontendController extends Controller
{
    // Hari libur nasional Indonesia 2025 & 2026
    protected array $publicHolidays = [
        // 2025
        '2025-01-01', '2025-01-27', '2025-01-29',
        '2025-03-29', '2025-03-31', '2025-04-01',
        '2025-04-18', '2025-04-20',
        '2025-05-01', '2025-05-12', '2025-05-29',
        '2025-06-01', '2025-06-06', '2025-06-27',
        '2025-08-17', '2025-09-05',
        '2025-12-25', '2025-12-26',
        // 2026
        '2026-01-01', '2026-01-16', '2026-02-17',
        '2026-03-19', '2026-03-20',
        '2026-04-03',
        '2026-05-01', '2026-05-14', '2026-05-26', '2026-05-27',
        '2026-06-01',
        '2026-08-17',
        '2026-12-25',
    ];

    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key') ?? env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    protected function isWeekendOrHoliday(string $date): bool
    {
        $carbon = Carbon::parse($date);
        $dayOfWeek = $carbon->dayOfWeek; // 0=Sun, 6=Sat
        if ($dayOfWeek === 0 || $dayOfWeek === 6) return true;
        return in_array($carbon->format('Y-m-d'), $this->publicHolidays);
    }

    public function index()
    {
        $news = News::latest()->take(3)->get();
        return view('welcome', compact('news'));
    }

    public function news()
    {
        $news = News::latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    public function showNews(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function orderForm()
    {
        $ticketTypes = TicketType::all();
        return view('order', compact('ticketTypes'));
    }

    public function processOrder(Request $request)
    {
        $request->validate([
            'visit_date'      => 'required|date|after_or_equal:today',
            'ticket_type_id'  => 'required|exists:ticket_types,id',
            'quantity'        => 'required|integer|min:1|max:20',
            'payment_method'  => 'required|in:qris,bank_transfer,gopay',
        ]);

        // Server-side verification: ensure the ticket_type matches the date
        $isWeekend = $this->isWeekendOrHoliday($request->visit_date);
        $expectedType = $isWeekend ? 'weekend' : 'weekday';
        $ticketType = TicketType::where('id', $request->ticket_type_id)
                                ->where('type', $expectedType)
                                ->firstOrFail();

        $totalPrice = $ticketType->price * $request->quantity;
        $orderNumber = 'ORD-' . strtoupper(Str::random(8));

        $order = Order::create([
            'order_number'   => $orderNumber,
            'user_id'        => auth()->id(),
            'ticket_type_id' => $ticketType->id,
            'visit_date'     => $request->visit_date,
            'quantity'       => $request->quantity,
            'total_price'    => $totalPrice,
            'payment_status' => 'pending',
        ]);

        $enabledPayments = match ($request->payment_method) {
            'qris'          => ['qris'],
            'bank_transfer' => ['bank_transfer', 'echannel', 'permata_va', 'bca_va', 'bni_va', 'bri_va'],
            'gopay'         => ['gopay', 'shopeepay'],
            default         => [],
        };

        $params = [
            'transaction_details' => [
                'order_id'    => $order->order_number,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email'      => auth()->user()->email,
            ],
            'enabled_payments' => empty($enabledPayments) ? null : $enabledPayments,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            $order->update(['snap_token' => 'dummy_token_for_testing']);
        }

        return redirect()->route('customer.payment', $order->id);
    }

    public function payment(Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        if ($order->payment_status === 'success') {
            return redirect()->route('customer.eticket', $order->id);
        }

        // Jika snap_token masih dummy, buat ulang token baru
        if ($order->snap_token === 'dummy_token_for_testing' || empty($order->snap_token)) {
            $params = [
                'transaction_details' => [
                    'order_id'    => $order->order_number . '-' . time(),
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email'      => auth()->user()->email,
                ],
            ];
            try {
                $snapToken = Snap::getSnapToken($params);
                $order->update(['snap_token' => $snapToken]);
            } catch (\Exception $e) {
                // tetap dummy jika masih gagal
            }
        }

        return view('payment', compact('order'));
    }

    public function paymentSuccess(Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        return view('payment_success', compact('order'));
    }

    public function eticket(Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        if ($order->payment_status !== 'success') {
            return redirect()->route('customer.payment', $order->id)
                ->with('error', 'Silakan selesaikan pembayaran terlebih dahulu.');
        }
        return view('eticket', compact('order'));
    }

    public function myTickets()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('my_tickets', compact('orders'));
    }

    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            $order = Order::where('order_number', $request->order_id)->first();
            if ($order) {
                if (in_array($request->transaction_status, ['capture', 'settlement'])) {
                    $order->update(['payment_status' => 'success']);
                } elseif (in_array($request->transaction_status, ['cancel', 'deny', 'expire'])) {
                    $order->update(['payment_status' => 'failed']);
                }
            }
        }
        return response()->json(['message' => 'success']);
    }
}
