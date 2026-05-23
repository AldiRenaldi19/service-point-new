<x-filament-widgets::widget>
    <x-filament::section class="overflow-hidden !p-0 border-none shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
        <div class="relative p-6 bg-white dark:bg-gray-900 transition-colors duration-300">
            
            {{-- 🛠️ FORCE GRID: Di desktop langsung dipatok jadi 12 kolom --}}
            <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-center relative z-10 w-full">
                
                {{-- ==========================================
                     1. DYNAMIC GREETING CONTENT (GRID LOCK)
                     ========================================== --}}
                {{-- 🛠️ Teks dipaksa mengambil 9 dari 12 kolom ruang desktop --}}
                <div class="text-center md:text-left md:col-span-9 w-full">
                    <h2 class="text-xl font-bold text-gray-950 dark:text-white tracking-tight block">
                        Selamat datang kembali, {{ explode(' ', trim(auth()->user()->name))[0] }}!
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1 leading-relaxed max-w-full block">
                        Senang melihatmu lagi. Semuanya terkendali di <span class="font-bold text-blue-600 dark:text-blue-400">Service Point</span>. 
                        Ayo cek stok hari ini atau buat artikel blog baru untuk pelanggan.
                    </p>
                </div>

                {{-- ==========================================
                     2. QUICK ACTION SHORTCUT
                     ========================================== --}}
                {{-- 🛠️ Tombol mengambil sisa 3 kolom di desktop --}}
                <div class="md:col-span-3 w-full flex justify-center md:justify-end">
                    <x-filament::button 
                        href="{{ route('blog.index') }}" 
                        tag="a" 
                        target="_blank"
                        color="gray" 
                        icon="heroicon-m-arrow-top-right-on-square"
                        class="rounded-xl shadow-sm border-gray-200 dark:border-gray-700 w-full md:w-auto justify-center"
                    >
                        Lihat Blog
                    </x-filament::button>
                </div>

            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>