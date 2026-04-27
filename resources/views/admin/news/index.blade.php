<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Berita</h2>
            <a href="{{ route('admin.news.create') }}" style="background-color:#2563eb;color:white;" class="font-bold py-2 px-6 rounded-lg shadow-lg hover:opacity-90 transition">+ Tambah Berita Baru</a>
        </div>
    </x-slot>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

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
                    @forelse($news as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900">{{ $item->title }}</p>
                            <p class="text-gray-500 text-sm line-clamp-1">{{ Str::limit($item->content, 80) }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" class="w-16 h-12 object-cover rounded-lg shadow-sm">
                            @else
                                <span class="text-xs text-gray-400 italic">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.news.edit', $item) }}"
                                   style="background-color:#f59e0b;color:white;"
                                   class="text-sm font-bold px-4 py-1.5 rounded-lg hover:opacity-90 transition">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            style="background-color:#dc2626;color:white;"
                                            class="text-sm font-bold px-4 py-1.5 rounded-lg hover:opacity-90 transition">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-lg font-medium">Belum ada berita.</p>
                            <p class="text-sm mt-1">Klik tombol "Tambah Berita Baru" untuk mulai menambahkan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</x-app-layout>