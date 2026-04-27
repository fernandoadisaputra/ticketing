<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.news.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Berita</h2>
        </div>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8">

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Judul Berita</label>
                    <input type="text" name="title"
                        value="{{ old('title', $news->title) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Konten Berita</label>
                    <textarea name="content" rows="8"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required>{{ old('content', $news->content) }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Gambar</label>
                    @if($news->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/'.$news->image) }}" class="w-48 h-32 object-cover rounded-lg shadow-sm mb-2">
                            <p class="text-xs text-gray-500">Gambar saat ini. Upload gambar baru di bawah untuk menggantinya.</p>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB. Kosongkan jika tidak ingin mengganti gambar.</p>
                </div>

                <div class="flex gap-4 mt-8">
                    <button type="submit" style="background-color:#2563eb;color:white;" class="flex-1 font-black text-base py-3 rounded-lg hover:opacity-90 transition shadow-lg">
                        💾 Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="flex-1 text-center py-3 rounded-lg font-bold border-2 border-gray-300 text-gray-600 hover:bg-gray-50 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
