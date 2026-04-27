<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Pembayaran Berhasil</h2></x-slot>
    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 text-green-600">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-2xl font-bold mb-2">Terima Kasih!</h3>
            <p class="text-gray-600 mb-8">Pembayaran pesanan {{ $order->order_number }} telah kami terima.</p>
            
            <a href="{{ route('customer.eticket', $order->id) }}" class="inline-block bg-blue-600 text-white font-bold px-8 py-3 rounded-lg shadow hover:bg-blue-700 transition">Lihat E-Ticket</a>
        </div>
    </div>
</x-app-layout>