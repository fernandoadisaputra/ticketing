<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tiket Saya</h2></x-slot>
    <div class="py-12 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($orders as $order)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex">
                <div class="w-1/3 bg-blue-50 p-4 flex flex-col justify-center items-center text-center border-r border-dashed border-gray-300">
                    <p class="text-xs text-gray-500 uppercase">Tanggal</p>
                    <p class="font-bold text-lg text-blue-700">{{ date('d', strtotime($order->visit_date)) }}</p>
                    <p class="text-sm font-bold text-blue-700">{{ date('M Y', strtotime($order->visit_date)) }}</p>
                </div>
                <div class="w-2/3 p-4 relative">
                    <h4 class="font-bold text-lg mb-1">{{ optional($order->ticketType)->name ?? 'Tiket' }}</h4>
                    <p class="text-sm text-gray-600 mb-3">{{ $order->quantity }} Tiket</p>
                    
                    @if($order->payment_status == 'success')
                        <a href="{{ route('customer.eticket', $order->id) }}" class="inline-block bg-green-100 text-green-700 font-medium px-3 py-1 rounded text-sm hover:bg-green-200">Lihat E-Ticket</a>
                    @elseif($order->payment_status == 'pending')
                        <a href="{{ route('customer.payment', $order->id) }}" class="inline-block bg-yellow-100 text-yellow-700 font-medium px-3 py-1 rounded text-sm hover:bg-yellow-200">Lanjutkan Pembayaran</a>
                    @else
                        <span class="inline-block bg-red-100 text-red-700 font-medium px-3 py-1 rounded text-sm">Gagal</span>
                    @endif
                    
                    <p class="absolute top-4 right-4 text-xs font-mono text-gray-400">{{ $order->order_number }}</p>
                </div>
            </div>
            @endforeach
            
            @if(count($orders) == 0)
                <div class="col-span-full text-center py-12 bg-white rounded-xl">
                    <p class="text-gray-500 mb-4">Anda belum memiliki tiket.</p>
                    <a href="{{ route('customer.order') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700">Pesan Sekarang</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>