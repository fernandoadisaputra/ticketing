<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Pembayaran</h2></x-slot>
    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center">
            <h3 class="text-2xl font-bold mb-4">Selesaikan Pembayaran Anda</h3>
            <p class="text-gray-600 mb-6">Total Tagihan: <span class="font-bold text-xl text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
            
            <button id="pay-button" class="bg-blue-600 text-white font-bold px-8 py-3 rounded-lg shadow hover:bg-blue-700 transition mb-4">Bayar Sekarang (QRIS / Bank)</button>
            
            <div class="mt-8 pt-8 border-t border-gray-200">
                <a href="{{ route('customer.payment.success', $order->id) }}" class="text-sm text-gray-500 underline hover:text-blue-600">Saya sudah membayar (Cek Status)</a>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap -->
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            var token = '{{ $order->snap_token }}';
            if(token === 'dummy_token_for_testing'){
                alert("Simulasi Pembayaran Berhasil!\n(Midtrans Key belum dikonfigurasi, membypass ke halaman e-ticket)");
                window.location.href = '{{ route('customer.payment.success', $order->id) }}';
                return;
            }
            snap.pay(token, {
                onSuccess: function(result){
                    window.location.href = '{{ route('customer.payment.success', $order->id) }}';
                },
                onPending: function(result){
                    alert("Menunggu pembayaran Anda!");
                },
                onError: function(result){
                    alert("Pembayaran gagal!");
                },
                onClose: function(){
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                }
            });
        };
    </script>
</x-app-layout>