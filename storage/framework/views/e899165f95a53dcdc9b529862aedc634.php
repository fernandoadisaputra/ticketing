<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pembayaran</h2> <?php $__env->endSlot(); ?>
    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center">
            <h3 class="text-2xl font-bold mb-4">Selesaikan Pembayaran Anda</h3>
            <p class="text-gray-600 mb-6">Total Tagihan: <span class="font-bold text-xl text-blue-600">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></span></p>
            
            <button id="pay-button" class="bg-blue-600 text-white font-bold px-8 py-3 rounded-lg shadow hover:bg-blue-700 transition mb-4">Bayar Sekarang (QRIS / Bank)</button>
            
            <div class="mt-8 pt-8 border-t border-gray-200">
                <a href="<?php echo e(route('customer.payment.success', $order->id)); ?>" class="text-sm text-gray-500 underline hover:text-blue-600">Saya sudah membayar (Cek Status)</a>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap -->
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="<?php echo e(env('MIDTRANS_CLIENT_KEY')); ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            var token = '<?php echo e($order->snap_token); ?>';
            if(token === 'dummy_token_for_testing'){
                alert("Simulasi Pembayaran Berhasil!\n(Midtrans Key belum dikonfigurasi, membypass ke halaman e-ticket)");
                window.location.href = '<?php echo e(route('customer.payment.success', $order->id)); ?>';
                return;
            }
            snap.pay(token, {
                onSuccess: function(result){
                    window.location.href = '<?php echo e(route('customer.payment.success', $order->id)); ?>';
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\Xampp\htdocs\ticketing\resources\views/payment.blade.php ENDPATH**/ ?>