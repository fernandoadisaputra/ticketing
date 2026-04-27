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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Berita</h2>
            <a href="<?php echo e(route('admin.news.create')); ?>" style="background-color:#2563eb;color:white;" class="font-bold py-2 px-6 rounded-lg shadow-lg hover:opacity-90 transition">+ Tambah Berita Baru</a>
        </div>
     <?php $__env->endSlot(); ?>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <?php if(session('success')): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Berita</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900"><?php echo e($item->title); ?></p>
                            <p class="text-gray-500 text-sm line-clamp-1"><?php echo e(Str::limit($item->content, 80)); ?></p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?php echo e($item->created_at->format('d M Y')); ?>

                        </td>
                        <td class="px-6 py-4">
                            <?php if($item->image): ?>
                                <img src="<?php echo e(asset('storage/'.$item->image)); ?>" class="w-16 h-12 object-cover rounded-lg shadow-sm">
                            <?php else: ?>
                                <span class="text-xs text-gray-400 italic">Tidak ada gambar</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <a href="<?php echo e(route('admin.news.edit', $item)); ?>"
                                   style="background-color:#f59e0b;color:white;"
                                   class="text-sm font-bold px-4 py-1.5 rounded-lg hover:opacity-90 transition">
                                    ✏️ Edit
                                </a>
                                <form action="<?php echo e(route('admin.news.destroy', $item)); ?>" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                            style="background-color:#dc2626;color:white;"
                                            class="text-sm font-bold px-4 py-1.5 rounded-lg hover:opacity-90 transition">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-lg font-medium">Belum ada berita.</p>
                            <p class="text-sm mt-1">Klik tombol "Tambah Berita Baru" untuk mulai menambahkan.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-gray-100">
                <?php echo e($news->links()); ?>

            </div>
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
<?php endif; ?><?php /**PATH D:\Xampp\htdocs\ticketing\resources\views/admin/news/index.blade.php ENDPATH**/ ?>