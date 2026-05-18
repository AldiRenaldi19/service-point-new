<x-filament-widgets::widget>
    <x-filament::section class="overflow-hidden !p-0 border-none shadow-xl bg-gradient-to-br from-amber-500 to-orange-600">
        <div class="relative p-8">
            {{-- Konten Utama --}}
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="text-center md:text-left text-white">
                    <h2 class="text-3xl font-black italic tracking-tighter uppercase">
                        HELLO, {{ strtoupper(auth()->user()->name) }}! ✨
                    </h2>
                    <p class="mt-2 text-amber-100 font-medium max-w-md">
                        Selamat datang di portal pelanggan <span class="font-bold underline">Service Point</span>. 
                        Cek status servis atau cari sparepart favorit di sini.
                    </div>
                
                <div class="flex gap-3">
                    <a href="/" class="px-6 py-3 bg-white text-orange-600 text-xs font-bold uppercase tracking-widest rounded-2xl hover:bg-amber-50 transition-all shadow-lg">
                        Cek Katalog Produk
                    </a>
                </div>
            </div>

            {{-- Ornamen Dekorasi --}}
            <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 translate-y-12 -translate-x-12 w-48 h-48 bg-black/10 rounded-full blur-2xl"></div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>