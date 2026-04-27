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
     <?php $__env->slot('header', null, []); ?> <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tiket Saya</h2> <?php $__env->endSlot(); ?>
    <div class="py-12 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex">
                <div class="w-1/3 bg-blue-50 p-4 flex flex-col justify-center items-center text-center border-r border-dashed border-gray-300">
                    <p class="text-xs text-gray-500 uppercase">Tanggal</p>
                    <p class="font-bold text-lg text-blue-700"><?php echo e(date('d', strtotime($order->visit_date))); ?></p>
                    <p class="text-sm font-bold text-blue-700"><?php echo e(date('M Y', strtotime($order->visit_date))); ?></p>
                </div>
                <div class="w-2/3 p-4 relative">
                    <h4 class="font-bold text-lg mb-1"><?php echo e(optional($order->ticketType)->name ?? 'Tiket'); ?></h4>
                    <p class="text-sm text-gray-600 mb-3"><?php echo e($order->quantity); ?> Tiket</p>
                    
                    <?php if($order->payment_status == 'success'): ?>
                        <a href="<?php echo e(route('customer.eticket', $order->id)); ?>" class="inline-block bg-green-100 text-green-700 font-medium px-3 py-1 rounded text-sm hover:bg-green-200">Lihat E-Ticket</a>
                    <?php elseif($order->payment_status == 'pending'): ?>
                        <a href="<?php echo e(route('customer.payment', $order->id)); ?>" class="inline-block bg-yellow-100 text-yellow-700 font-medium px-3 py-1 rounded text-sm hover:bg-yellow-200">Lanjutkan Pembayaran</a>
                    <?php else: ?>
                        <span class="inline-block bg-red-100 text-red-700 font-medium px-3 py-1 rounded text-sm">Gagal</span>
                    <?php endif; ?>
                    
                    <p class="absolute top-4 right-4 text-xs font-mono text-gray-400"><?php echo e($order->order_number); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(count($orders) == 0): ?>
                <div class="col-span-full text-center py-12 bg-white rounded-xl">
                    <p class="text-gray-500 mb-4">Anda belum memiliki tiket.</p>
                    <a href="<?php echo e(route('customer.order')); ?>" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700">Pesan Sekarang</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\Xampp\htdocs\ticketing\resources\views/my_tickets.blade.php ENDPATH**/ ?>