<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">E-Ticket Anda</h2></x-slot>
    <div class="py-12 max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-200">
            <div class="bg-blue-600 p-6 text-center text-white">
                <h3 class="text-2xl font-black">KLUB KELUARGA</h3>
                <p class="text-blue-100 text-sm">Graha Raya</p>
            </div>
            <div class="p-6 text-center">
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Tanggal Kunjungan</p>
                <p class="text-xl font-bold mb-6">{{ date('d M Y', strtotime($order->visit_date)) }}</p>
                
                <div class="flex justify-between items-center bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="text-left">
                        <p class="text-xs text-gray-500 uppercase">Jenis</p>
                        <p class="font-bold">{{ $order->ticketType->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500 uppercase">Jumlah</p>
                        <p class="font-bold text-xl text-blue-600">{{ $order->quantity }} Pax</p>
                    </div>
                </div>
                
                <div class="py-4 border-t border-b border-dashed border-gray-300 mb-6">
                    <p class="text-sm text-gray-600 mb-2">Tunjukkan kode ini ke petugas kasir</p>
                    <p class="text-2xl font-mono font-black tracking-widest">{{ $order->order_number }}</p>
                </div>
                
                <p class="text-xs text-gray-400">Dipesan oleh: {{ $order->user->name }}</p>
            </div>
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('customer.my_tickets') }}" class="text-blue-600 hover:underline font-medium">&larr; Kembali ke Daftar Tiket</a>
        </div>
    </div>
</x-app-layout>