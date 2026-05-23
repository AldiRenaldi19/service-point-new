<x-filament-widgets::widget>
    {{-- ==========================================
         1. GRADIENT BANNER CONTAINER
         Mendukung transisi skema warna oranye-amber tebal dan responsif.
         ========================================== --}}
    <div class="overflow-hidden rounded-xl border border-transparent shadow-xl bg-gradient-to-br from-amber-500 to-orange-600 dark:from-amber-600 dark:to-orange-700">
        <div class="relative p-8">
            
            {{-- Konten Utama Layar --}}
            <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-6">
                
                {{-- ==========================================
                     2. TEXT GREETING SECTION
                     ========================================== --}}
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-black italic tracking-tighter uppercase text-white drop-shadow-sm">
                        HELLO, {{ strtoupper(explode(' ', trim(auth()->user()->name))[0]) }}! ✨
                    </h2>
                    <p class="mt-2 font-medium max-w-md text-amber-100 text-sm leading-relaxed">
                        Selamat datang di portal pelanggan <span class="font-bold underline text-white">Service Point</span>. 
                        Bantu kami berkembang dengan menuliskan ulasan servis Anda atau jelajahi katalog kami.
                    </p>
                </div>
                
                {{-- ==========================================
                     3. INTERACTIVE ACTION BUTTONS
                     ========================================== --}}
                <div class="flex flex-col sm:flex-row gap-3.5 w-full sm:w-auto items-center">
                    
                    {{-- 🛠️ ASLI FILAMENT COMPONENT: Tombol Utama "Tulis Testimoni" --}}
                    {{-- Menggunakan warna putih/gray kontras tinggi, otomatis menyesuaikan light/dark mode --}}
                    <x-filament::button
                        tag="a"
                        href="{{ \App\Filament\App\Resources\TestimonialResource::getUrl('create') }}"
                        icon="heroicon-m-pencil-square"
                        color="gray"
                        size="xl"
                        class="w-full sm:w-auto font-black tracking-widest uppercase rounded-xl shadow-md transition-all duration-300 hover:scale-105"
                    >
                        Tulis Testimoni
                    </x-filament::button>

                    {{-- 🛠️ ASLI FILAMENT COMPONENT: Tombol Sekunder "Cek Katalog" --}}
                    {{-- Menggunakan tipe 'outlined' transparan yang kontras di atas background gradient --}}
                    <x-filament::button
                        tag="a"
                        href="{{ route('katalog') }}"
                        color="white"
                        labeled-from="sm"
                        outlined
                        size="xl"
                        class="w-full sm:w-auto font-black tracking-widest uppercase rounded-xl transition-all duration-300 hover:bg-white/10"
                    >
                        Cek Katalog Produk
                    </x-filament::button>
                </div>
            </div>

            {{-- ==========================================
                 4. LIGHTING ORNAMENT DECORATIONS
                 ========================================== --}}
            <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none z-0"></div>
            <div class="absolute bottom-0 left-0 translate-y-12 -translate-x-12 w-48 h-48 bg-black/10 rounded-full blur-2xl pointer-events-none z-0"></div>
        </div>
    </div>
</x-filament-widgets::widget>