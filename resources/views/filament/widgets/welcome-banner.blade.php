<x-filament-widgets::widget>
    <x-filament::section class="overflow-hidden !p-0 border-none shadow-sm">
        <div class="relative p-6 bg-white dark:bg-gray-900">
            <div class="flex flex-col md:flex-row items-center gap-5 relative z-10">
                
                {{-- Foto Profil User (Menggunakan logic yang baru kita buat) --}}
                <div class="flex-shrink-0">
                    @if(auth()->user()->getFilamentAvatarUrl())
                        <img src="{{ auth()->user()->getFilamentAvatarUrl() }}" 
                            alt="{{ auth()->user()->name }}" 
                            class="w-20 h-20 rounded-2xl object-cover shadow-md border-2 border-white dark:border-gray-800 rotate-2">
                    @else
                        {{-- Fallback jika tidak ada foto --}}
                        <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/40 rotate-3">
                            <span class="text-2xl font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>

                {{-- Greeting Text --}}
                <div class="text-center md:text-left flex-1">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">
                        Selamat datang kembali, {{ explode(' ', trim(auth()->user()->name))[0] }}! ✨
                    </h2>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-1 leading-relaxed">
                        Senang melihatmu lagi. Semuanya terkendali di <span class="font-semibold text-blue-600">Service Point</span>. 
                        Ayo cek stok hari ini atau buat artikel blog baru.
                    </p>
                </div>

                {{-- Action Button --}}
                <div class="md:ml-auto">
                    <x-filament::button 
                        href="{{ route('blog.index') }}" 
                        tag="a" 
                        target="_blank"
                        color="gray" 
                        icon="heroicon-m-arrow-top-right-on-square"
                        icon-alias="panels::widgets.account.logout-button"
                        class="rounded-xl shadow-none border-slate-200"
                    >
                        Lihat Blog
                    </x-filament::button>
                </div>
            </div>

            {{-- Dekorasi Minimalis --}}
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <x-heroicon-o-sparkles class="w-24 h-24 text-blue-500" />
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>