<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Service Point | Professional Auto Care')</title>
    
    {{-- ==========================================
         1. FAVICON TAGS
         ========================================== --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}?v=1" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v=1" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=1" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=1" />
    <meta name="apple-mobile-web-app-title" content="Service" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />

    {{-- ==========================================
         2. SEO META TAGS
         ========================================== --}}
    <meta name="description" content="Bengkel Modern Jatiasih - Solusi perawatan kendaraan profesional dengan teknologi diagnosa terkini.">
    <meta property="og:title" content="Service Point | Professional Auto Care">
    <meta property="og:description" content="Perawatan kendaraan profesional di Jatiasih dengan teknologi modern.">
    <meta property="og:image" content="{{ asset('assets/img/student-collaboration.jpeg') }}"> 
    <meta property="og:type" content="website">

    {{-- ==========================================
         3. EXTERNAL ASSETS & STYLES
         ========================================== --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass-nav { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); }
        @keyframes floating {
            0% { transform: translate(0, 0px) rotate(2deg); }
            50% { transform: translate(0, 15px) rotate(2deg); }
            100% { transform: translate(0, -0px) rotate(2deg); }   
        }
        .animate-float { animation: floating 3s ease-in-out infinite; }
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.6s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>

    {{-- Wadah suntuntan style kustom spesifik dari child-view --}}
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-900 pb-20 md:pb-0">

    {{-- Penentuan Klaster Dashboard Secara Dinamis Berdasarkan Hak Akses Pengguna --}}
    @php
        $dashboardUrl = '/app';
        if (auth()->check() && in_array(auth()->user()->role, ['super_admin', 'admin'])) {
            $dashboardUrl = '/admin';
        }
    @endphp

    {{-- ==========================================
         4. DESKTOP NAVIGATION BAR
         ========================================== --}}
    <nav class="glass-nav shadow-sm sticky top-0 z-50 border-b border-slate-100 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                {{-- Identitas Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 group cursor-pointer">
                    <div class="bg-blue-950 p-2.5 rounded-xl group-hover:rotate-12 transition-all duration-300 shadow-lg shadow-blue-900/20">
                        <i class="fa-solid fa-screwdriver-wrench text-white text-xl"></i>
                    </div>
                    <span class="font-black text-2xl tracking-tighter text-blue-950 uppercase italic">Service<span class="text-blue-700">Point.</span></span>
                </a>
                
                {{-- Link Menu Navigasi Desktop --}}
                <div class="flex items-center gap-10">
                    <div class="flex space-x-6 text-[11px] font-black uppercase tracking-[0.2em] text-slate-500">
                        <a href="{{ url('/#services') }}" class="hover:text-blue-700 transition">Layanan</a>
                        <a href="{{ url('/#testimonials') }}" class="hover:text-blue-700 transition">Testimoni</a>
                        <a href="{{ url('/#location') }}" class="hover:text-blue-700 transition">Lokasi</a>
                        <a href="{{ route('katalog') }}" class="hover:text-blue-700 transition {{ request()->routeIs('katalog') ? 'text-blue-700' : '' }}">Katalog</a>
                        <a href="{{ route('blog.index') }}" class="hover:text-blue-700 transition {{ request()->routeIs('blog.*') ? 'text-blue-700' : '' }}">Artikel</a>
                        <a href="{{ route('about') }}" class="hover:text-blue-700 transition {{ request()->routeIs('about') ? 'text-blue-700' : '' }}">Tentang Kami</a>
                    </div>
                    
                    {{-- Akses Gerbang Dashboard --}}
                    <a href="{{ $dashboardUrl }}" class="bg-blue-950 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-400 hover:text-blue-950 transition-all duration-300 shadow-lg shadow-blue-900/10 hover:shadow-amber-400/20">
                        <i class="fa-solid fa-user-shield mr-2"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- ==========================================
         5. MOBILE TOP BAR
         ========================================== --}}
    <div class="md:hidden glass-nav sticky top-0 z-50 border-b border-slate-100 p-4 flex justify-center">
        <span class="font-black text-xl tracking-tighter text-blue-950 uppercase italic">Service<span class="text-blue-700">Point.</span></span>
    </div>

    {{-- ==========================================
         6. MAIN RENDER CONTENT CONTAINER
         ========================================== --}}
    <main>
        @yield('content')
    </main>

    {{-- ==========================================
         7. DESKTOP FOOTER SECTION
         ========================================== --}}
    <footer class="bg-blue-950 text-white py-12 px-4 hidden md:block">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8 border-t border-white/5 pt-10">
            <p class="text-[10px] text-blue-300 font-black tracking-[0.3em] uppercase">&copy; 2026 Service Point. Pro Auto Care.</p>
        </div>
    </footer>

    {{-- ==========================================
         8. MOBILE BOTTOM NAVIGATION BAR
         ========================================== --}}
    <nav class="md:hidden fixed bottom-4 left-4 right-4 bg-blue-950 rounded-3xl shadow-2xl z-50 px-4 py-4 border border-white/10">
        <div class="flex justify-between items-center gap-1">
            {{-- Nav Home --}}
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('home') ? 'text-amber-400' : 'text-white/50' }}">
                <i class="fa-solid fa-house text-base"></i>
                <span class="text-[7px] font-black uppercase tracking-widest">Home</span>
            </a>
            {{-- Nav Testimoni --}}
            <a href="{{ url('/#testimonials') }}" class="flex flex-col items-center gap-1 text-white/50 hover:text-amber-400">
                <i class="fa-solid fa-comments text-base"></i>
                <span class="text-[7px] font-black uppercase tracking-widest">Testi</span>
            </a>
            {{-- Nav Katalog --}}
            <a href="{{ route('katalog') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('katalog') ? 'text-amber-400' : 'text-white/50' }}">
                <i class="fa-solid fa-book-open text-base"></i>
                <span class="text-[7px] font-black uppercase tracking-widest">Katalog</span>
            </a>
            {{-- Nav Artikel --}}
            <a href="{{ route('blog.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('blog.*') ? 'text-amber-400' : 'text-white/50' }}">
                <i class="fa-solid fa-newspaper text-base"></i>
                <span class="text-[7px] font-black uppercase tracking-widest">Artikel</span>
            </a>
            {{-- Nav About --}}
            <a href="{{ route('about') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('about') ? 'text-amber-400' : 'text-white/50' }}">
                <i class="fa-solid fa-circle-info text-base"></i>
                <span class="text-[7px] font-black uppercase tracking-widest">About</span>
            </a>
            {{-- Nav Dashboard Dinamis --}}
            <a href="{{ $dashboardUrl }}" class="flex flex-col items-center gap-1 {{ (str_contains(request()->url(), '/app') || str_contains(request()->url(), '/admin')) ? 'text-amber-400' : 'text-white/50' }}">
                <i class="fa-solid fa-user-lock text-base"></i>
                <span class="text-[7px] font-black uppercase tracking-widest">Dashboard</span>
            </a>
        </div>
    </nav>

    {{-- ==========================================
         9. FLOATING WHATSAPP BUTTON (GLOBAL)
         ========================================== --}}
    <a href="https://wa.me/6287884323768?text=Halo%20Service%20Point,%20saya%20mau%20booking%20service%20atau%20tanya%20produk..." 
       target="_blank" 
       class="fixed bottom-24 md:bottom-10 right-6 z-[60] group flex items-center gap-3">
        
        <span class="bg-white text-blue-950 text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-xl shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-4 group-hover:translate-x-0 pointer-events-none hidden md:block">
            Booking Sekarang
        </span>

        <div class="relative">
            <span class="absolute inset-0 rounded-full bg-green-500 animate-ping opacity-20"></span>
            <div class="relative bg-green-500 text-white w-14 h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center shadow-2xl shadow-green-500/40 group-hover:scale-110 transition-all duration-300">
                <i class="fa-brands fa-whatsapp text-2xl md:text-3xl"></i>
            </div>
        </div>
    </a>

    {{-- ==========================================
         10. JAVASCRIPT GLOBAL LOGIC
         ========================================== --}}
    <script>
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }
        window.scrollTo(0, 0);

        function reveal() {
            const reveals = document.querySelectorAll(".reveal:not(.active)"); // Saring yang belum aktif saja agar ringan
            const windowHeight = window.innerHeight;
            
            reveals.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                const revealPoint = 100;
                
                if (elementTop < windowHeight - revealPoint) {
                    el.classList.add("active");
                }
            });
        }

        window.addEventListener("scroll", reveal);
        document.addEventListener("DOMContentLoaded", function() {
            reveal();
        });
    </script>

    {{-- Menampung tumpukan script bawaan halaman anak --}}
    @stack('scripts')
</body>
</html>