<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-8 text-gray-900 text-center">
                    <h3 class="text-3xl font-black mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600 mb-8">Pesan tiket kolam renang Klub Keluarga Graha Raya dengan mudah tanpa antre panjang.</p>
                    
                    <a href="{{ route('customer.order') }}" style="background-color: #f97316; color: white;" class="inline-block font-black text-lg px-8 py-4 rounded-full shadow-lg hover:opacity-90 transition">
                        Pesan Tiket Sekarang
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('customer.my_tickets') }}" class="block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 transition border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Tiket Saya</h3>
                            <p class="text-gray-500">Lihat E-Ticket dan riwayat pesanan tiket Anda.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" class="block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 transition border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Pengaturan Profil</h3>
                            <p class="text-gray-500">Ubah detail akun dan password Anda.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
