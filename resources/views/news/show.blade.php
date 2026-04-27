<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $news->title }}</h2></x-slot>
    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
            @if($news->image)
                <img src="{{ asset('storage/'.$news->image) }}" class="w-full h-64 object-cover rounded-lg mb-6">
            @endif
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($news->content)) !!}
            </div>
            <div class="mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('home') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</x-app-layout>