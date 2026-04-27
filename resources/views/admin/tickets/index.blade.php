<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Harga Tiket</h2>
        </div>
    </x-slot>
    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <p class="text-gray-600 mb-6">Atur harga tiket untuk hari Weekday dan Weekend. Harga Weekend juga berlaku pada hari libur nasional.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($ticketTypes as $ticket)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div style="background-color: {{ $ticket->type === 'weekend' ? '#7c3aed' : '#059669' }};" class="p-4">
                    <span class="text-white font-black text-lg">
                        {{ $ticket->type === 'weekend' ? '🌅 Tiket Weekend' : '💼 Tiket Weekday' }}
                    </span>
                    <p class="text-white/80 text-sm mt-1">
                        {{ $ticket->type === 'weekend' ? 'Sabtu, Minggu & Hari Libur Nasional' : 'Senin - Jumat' }}
                    </p>
                </div>
                <div class="p-6">
                    <p class="text-gray-500 text-sm mb-1">Harga Saat Ini</p>
                    <p class="text-3xl font-black mb-6" style="color: {{ $ticket->type === 'weekend' ? '#7c3aed' : '#059669' }};">
                        Rp {{ number_format($ticket->price, 0, ',', '.') }}
                    </p>

                    <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Ubah Harga (Rp)</label>
                            <input type="number" name="price" value="{{ $ticket->price }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                required min="0" step="1000">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Keterangan (Opsional)</label>
                            <input type="text" name="description" value="{{ $ticket->description }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                        </div>
                        {{-- Pass-through hidden fields --}}
                        <input type="hidden" name="name" value="{{ $ticket->name }}">
                        <button type="submit" style="background-color:#2563eb;color:white;" class="w-full font-bold py-2.5 px-4 rounded-lg hover:opacity-90 transition">
                            Simpan Perubahan Harga
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>