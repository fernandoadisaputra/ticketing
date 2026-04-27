<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticketing Graha Raya - Klub Keluarga</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .hero-gradient {
            background: linear-gradient(135deg, #0f766e 0%, #115e59 100%);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 selection:bg-brand-500 selection:text-white">

    <!-- Navbar -->
    <nav class="absolute w-full z-50 transition-all duration-300 py-4 px-6 md:px-12 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-brand-500 rounded-xl shadow-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h1 class="text-2xl font-black text-white tracking-tight drop-shadow-md">Klub Keluarga</h1>
        </div>
        <div class="flex items-center space-x-2 md:space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-brand-500 text-white px-4 py-2 md:px-6 md:py-2.5 text-sm md:text-base whitespace-nowrap rounded-full font-bold hover:bg-brand-600 hover:shadow-lg transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-white/20 backdrop-blur-md border border-white/30 text-white px-4 py-2 md:px-6 md:py-2.5 text-sm md:text-base whitespace-nowrap rounded-full font-bold hover:bg-white/30 transition">Log in</a>
                <a href="{{ route('register') }}" style="background-color: #f97316; color: white;" class="px-4 py-2 md:px-6 md:py-2.5 text-sm md:text-base whitespace-nowrap rounded-full font-bold hover:opacity-90 hover:shadow-lg transition transform hover:-translate-y-0.5">Daftar</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative min-h-[85vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="/ticketing/public/images/splash.jpeg" class="w-full h-full object-cover" alt="Pool">
            <div class="absolute inset-0 hero-gradient opacity-35"></div>
        </div>
        
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
            <span class="inline-block py-1 px-3 rounded-full bg-brand-500/30 border border-brand-400/50 text-brand-100 text-sm font-semibold tracking-wide mb-6 backdrop-blur-md">
                Splash Water Park
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-6 leading-tight drop-shadow-lg">
                Berenang Nyaman, <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-200 to-white">Tanpa Antre Panjang.</span>
            </h1>
            <p class="text-lg md:text-2xl text-brand-100 mb-10 max-w-3xl mx-auto font-light drop-shadow">
                Pesan tiket kolam renang secara online, pilih jadwal kunjungan Anda, dan dapatkan E-Ticket instan.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('customer.order') }}" class="bg-brand-500 text-white font-bold px-8 py-4 rounded-full shadow-[0_0_20px_rgba(20,184,166,0.4)] hover:shadow-[0_0_30px_rgba(20,184,166,0.6)] hover:-translate-y-1 transition transform duration-300 text-lg flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    Pesan Tiket Sekarang
                </a>
                @guest
                <a href="{{ route('register') }}" style="background-color: #f97316; color: white;" class="font-bold px-8 py-4 rounded-full shadow-lg hover:opacity-90 transition transform duration-300 text-lg flex items-center justify-center gap-2">
                    Daftar Sebagai Member
                </a>
                @endguest
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-full h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,119.93,197.36,112.5,239.5,107.81,281.44,82.5,321.39,56.44Z" class="fill-gray-50"></path>
            </svg>
        </div>
    </div>

    <!-- Features / News Section -->
    <div class="py-24 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-black text-gray-900 mb-4 tracking-tight">Kabar & Promosi Terbaru</h2>
                <div class="w-24 h-1 bg-brand-500 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($news as $item)
                <div class="group bg-white rounded-3xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="relative h-56 overflow-hidden">
                        @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-brand-100 to-brand-50 flex items-center justify-center text-brand-300 group-hover:scale-110 transition duration-500">
                                <svg class="w-16 h-16 opacity-50" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-sm text-brand-700 text-xs font-bold px-3 py-1 rounded-full shadow-sm">{{ $item->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-3 text-gray-900 group-hover:text-brand-600 transition">{{ $item->title }}</h3>
                        <p class="text-gray-500 leading-relaxed line-clamp-3 mb-6">{{ $item->content }}</p>
                        <a href="{{ route('news.show', $item) }}" class="inline-flex items-center text-brand-600 font-bold hover:text-brand-800 transition">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @if(count($news) == 0)
                <div class="text-center p-12 bg-white rounded-3xl shadow-sm border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20"></path></svg>
                    </div>
                    <p class="text-gray-500 text-lg">Belum ada kabar atau promosi terbaru saat ini.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-black text-white tracking-tight mb-4">Klub Keluarga Graha Raya</h2>
            <p class="mb-8">Sistem Pemesanan Tiket Kolam Renang Online</p>
            <p class="text-sm">&copy; {{ date('Y') }} Klub Keluarga. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>