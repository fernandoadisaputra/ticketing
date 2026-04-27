<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Berita</h2></x-slot>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label>Judul Berita</label>
                    <input type="text" name="title" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label>Konten</label>
                    <textarea name="content" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" rows="5" required></textarea>
                </div>
                <div class="mb-4">
                    <label>Gambar (Opsional)</label>
                    <input type="file" name="image" class="w-full mt-1">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </form>
        </div>
    </div>
</x-app-layout>