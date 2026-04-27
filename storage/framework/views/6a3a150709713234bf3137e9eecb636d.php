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
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Harga Tiket</h2>
        </div>
     <?php $__env->endSlot(); ?>
    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">

        <?php if(session('success')): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <p class="text-gray-600 mb-6">Atur harga tiket untuk hari Weekday dan Weekend. Harga Weekend juga berlaku pada hari libur nasional.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php $__currentLoopData = $ticketTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div style="background-color: <?php echo e($ticket->type === 'weekend' ? '#7c3aed' : '#059669'); ?>;" class="p-4">
                    <span class="text-white font-black text-lg">
                        <?php echo e($ticket->type === 'weekend' ? '🌅 Tiket Weekend' : '💼 Tiket Weekday'); ?>

                    </span>
                    <p class="text-white/80 text-sm mt-1">
                        <?php echo e($ticket->type === 'weekend' ? 'Sabtu, Minggu & Hari Libur Nasional' : 'Senin - Jumat'); ?>

                    </p>
                </div>
                <div class="p-6">
                    <p class="text-gray-500 text-sm mb-1">Harga Saat Ini</p>
                    <p class="text-3xl font-black mb-6" style="color: <?php echo e($ticket->type === 'weekend' ? '#7c3aed' : '#059669'); ?>;">
                        Rp <?php echo e(number_format($ticket->price, 0, ',', '.')); ?>

                    </p>

                    <form action="<?php echo e(route('admin.tickets.update', $ticket)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Ubah Harga (Rp)</label>
                            <input type="number" name="price" value="<?php echo e($ticket->price); ?>"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                required min="0" step="1000">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Keterangan (Opsional)</label>
                            <input type="text" name="description" value="<?php echo e($ticket->description); ?>"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                        </div>
                        
                        <input type="hidden" name="name" value="<?php echo e($ticket->name); ?>">
                        <button type="submit" style="background-color:#2563eb;color:white;" class="w-full font-bold py-2.5 px-4 rounded-lg hover:opacity-90 transition">
                            Simpan Perubahan Harga
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php endif; ?><?php /**PATH D:\Xampp\htdocs\ticketing\resources\views/admin/tickets/index.blade.php ENDPATH**/ ?>