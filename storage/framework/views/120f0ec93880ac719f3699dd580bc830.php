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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pesan Tiket Baru</h2>
     <?php $__env->endSlot(); ?>
    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

            <?php if($errors->any()): ?>
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('customer.order.process')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Tanggal Kunjungan</label>
                    <input type="date" id="visit_date" name="visit_date"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required min="<?php echo e(date('Y-m-d')); ?>"
                        value="<?php echo e(old('visit_date')); ?>">
                    <p id="day-label" class="text-sm mt-2 font-medium hidden"></p>
                </div>

                
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Jenis Tiket</label>
                    <div id="ticket-info" class="w-full border border-gray-200 bg-gray-50 rounded-lg p-4 text-gray-500">
                        <p class="text-sm italic">Pilih tanggal kunjungan terlebih dahulu untuk menentukan jenis tiket secara otomatis.</p>
                    </div>
                    
                    <input type="hidden" name="ticket_type_id" id="ticket_type_id">
                </div>

                
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Jumlah Tiket</label>
                    <input type="number" name="quantity" id="quantity" min="1" max="20" value="<?php echo e(old('quantity', 1)); ?>"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required>
                </div>

                
                <div class="mb-6" id="total-section" style="display:none;">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-bold text-gray-700">Total Harga:</span>
                        <span id="total-price" class="text-2xl font-black text-blue-600">Rp 0</span>
                    </div>
                </div>

                
                <div class="mb-8">
                    <label class="block text-gray-700 font-bold mb-2">Metode Pembayaran</label>
                    <select name="payment_method" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="qris" <?php echo e(old('payment_method') == 'qris' ? 'selected' : ''); ?>>QRIS</option>
                        <option value="bank_transfer" <?php echo e(old('payment_method') == 'bank_transfer' ? 'selected' : ''); ?>>Transfer Bank (Virtual Account)</option>
                        <option value="gopay" <?php echo e(old('payment_method') == 'gopay' ? 'selected' : ''); ?>>GoPay / E-Wallet</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-2">*Anda akan diarahkan ke halaman pembayaran setelah ini.</p>
                </div>

                <button type="submit" id="submit-btn" style="background-color: #f97316; color: white;" class="w-full font-black text-lg px-4 py-4 rounded-lg shadow-lg hover:opacity-90 transition">
                    Pesan Tiket Sekarang
                </button>
            </form>
        </div>
    </div>

    <script>
        // Data jenis tiket dari server
        const ticketTypes = <?php echo json_encode($ticketTypes, 15, 512) ?>;

        // Hari libur nasional Indonesia 2025 & 2026
        const publicHolidays = [
            // 2025
            '2025-01-01', // Tahun Baru Masehi
            '2025-01-27', // Isra Mi'raj
            '2025-01-29', // Tahun Baru Imlek
            '2025-03-29', // Hari Raya Nyepi
            '2025-03-31', // Idul Fitri 1446 H
            '2025-04-01', // Idul Fitri 1446 H
            '2025-04-18', // Wafat Isa Almasih
            '2025-04-20', // Paskah
            '2025-05-01', // Hari Buruh
            '2025-05-12', // Hari Raya Waisak
            '2025-05-29', // Kenaikan Isa Almasih
            '2025-06-01', // Hari Lahir Pancasila
            '2025-06-06', // Idul Adha
            '2025-06-27', // Tahun Baru Islam
            '2025-08-17', // HUT RI
            '2025-09-05', // Maulid Nabi
            '2025-12-25', // Natal
            '2025-12-26', // Cuti Bersama Natal
            // 2026
            '2026-01-01', // Tahun Baru Masehi
            '2026-01-16', // Isra Mi'raj
            '2026-02-17', // Tahun Baru Imlek
            '2026-03-19', // Idul Fitri (estimasi)
            '2026-03-20', // Idul Fitri (estimasi)
            '2026-04-03', // Wafat Isa Almasih
            '2026-05-01', // Hari Buruh
            '2026-05-26', // Waisak
            '2026-05-14', // Kenaikan Isa Almasih
            '2026-06-01', // Hari Lahir Pancasila
            '2026-05-27', // Idul Adha (estimasi)
            '2026-08-17', // HUT RI
            '2026-12-25', // Natal
        ];

        function isPublicHoliday(dateStr) {
            return publicHolidays.includes(dateStr);
        }

        function isWeekend(dateStr) {
            const date = new Date(dateStr + 'T00:00:00');
            const day = date.getDay(); // 0=Sun, 1=Mon, ..., 6=Sat
            return day === 0 || day === 6;
        }

        function getDayName(dateStr) {
            const date = new Date(dateStr + 'T00:00:00');
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            return days[date.getDay()];
        }

        function formatRupiah(num) {
            return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function updateTicketInfo() {
            const dateVal = document.getElementById('visit_date').value;
            const qtyVal = parseInt(document.getElementById('quantity').value) || 1;
            const ticketInfo = document.getElementById('ticket-info');
            const dayLabel = document.getElementById('day-label');
            const totalSection = document.getElementById('total-section');
            const totalPrice = document.getElementById('total-price');
            const hiddenInput = document.getElementById('ticket_type_id');

            if (!dateVal) {
                ticketInfo.innerHTML = '<p class="text-sm italic text-gray-500">Pilih tanggal kunjungan terlebih dahulu.</p>';
                dayLabel.classList.add('hidden');
                totalSection.style.display = 'none';
                hiddenInput.value = '';
                return;
            }

            const isWknd = isWeekend(dateVal);
            const isHoliday = isPublicHoliday(dateVal);
            const isWeekendType = isWknd || isHoliday;
            const dayName = getDayName(dateVal);

            // Cari ticket type yang sesuai
            const ticketType = ticketTypes.find(t => t.type === (isWeekendType ? 'weekend' : 'weekday'));

            if (!ticketType) {
                ticketInfo.innerHTML = '<p class="text-sm text-red-500">Data tiket tidak ditemukan. Hubungi admin.</p>';
                return;
            }

            hiddenInput.value = ticketType.id;

            // Update day label
            dayLabel.classList.remove('hidden');
            if (isHoliday && !isWknd) {
                dayLabel.className = 'text-sm mt-2 font-medium text-orange-600';
                dayLabel.innerHTML = '📅 ' + dayName + ' — <strong>Hari Libur Nasional</strong> (dihitung sebagai Weekend)';
            } else if (isWeekendType) {
                dayLabel.className = 'text-sm mt-2 font-medium text-purple-600';
                dayLabel.innerHTML = '🌅 ' + dayName + ' — <strong>Hari Weekend</strong>';
            } else {
                dayLabel.className = 'text-sm mt-2 font-medium text-green-600';
                dayLabel.innerHTML = '💼 ' + dayName + ' — <strong>Hari Weekday</strong>';
            }

            // Update ticket info box
            const colorClass = isWeekendType ? 'bg-purple-50 border-purple-200' : 'bg-green-50 border-green-200';
            const badge = isWeekendType
                ? '<span style="background:#7c3aed;color:white;" class="text-xs font-bold px-2 py-1 rounded-full">Weekend</span>'
                : '<span style="background:#059669;color:white;" class="text-xs font-bold px-2 py-1 rounded-full">Weekday</span>';
            ticketInfo.className = 'w-full border rounded-lg p-4 ' + colorClass;
            ticketInfo.innerHTML = `
                <div class="flex justify-between items-center">
                    <div>
                        ${badge}
                        <p class="font-bold text-gray-800 mt-1 text-lg">${ticketType.name}</p>
                        <p class="text-gray-500 text-sm">${ticketType.description ?? ''}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">Harga / orang</p>
                        <p class="text-2xl font-black text-gray-800">${formatRupiah(ticketType.price)}</p>
                    </div>
                </div>
            `;

            // Update total
            const total = ticketType.price * qtyVal;
            totalSection.style.display = 'block';
            totalPrice.textContent = formatRupiah(total);
        }

        document.getElementById('visit_date').addEventListener('change', updateTicketInfo);
        document.getElementById('quantity').addEventListener('input', updateTicketInfo);

        // Run on load if date already filled (e.g. old value after error)
        window.addEventListener('DOMContentLoaded', updateTicketInfo);
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
<?php endif; ?><?php /**PATH D:\Xampp\htdocs\ticketing\resources\views/order.blade.php ENDPATH**/ ?>