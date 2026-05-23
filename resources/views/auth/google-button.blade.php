<div class="mt-6 space-y-6">
    {{-- ==========================================
         1. VISUAL ORNAMENT DIVIDER
         ========================================== --}}
    <div class="relative flex items-center justify-center">
        <div class="flex-grow border-t border-gray-200 dark:border-gray-800"></div>
        <span class="mx-4 flex-shrink text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 dark:text-gray-500 bg-white dark:bg-gray-900 px-2 select-none">
            Atau
        </span>
        <div class="flex-grow border-t border-gray-200 dark:border-gray-800"></div>
    </div>

    {{-- ==========================================
         2. ACTION BUTTONS LAYER
         ========================================== --}}
    <div class="space-y-3.5">
        {{-- Tombol Integrasi OAuth Google --}}
        <a href="{{ route('google.redirect') }}" 
           class="flex w-full items-center justify-center gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-bold text-gray-700 shadow-sm transition-all duration-200 hover:bg-gray-50 hover:border-gray-300 hover:shadow-md dark:border-gray-800 dark:bg-gray-950 dark:text-gray-200 dark:hover:bg-gray-900 dark:hover:border-gray-700 group">
            
            {{-- SVG Logo Google Asli --}}
            <svg class="h-5 w-5 transform group-hover:scale-105 transition-transform duration-200" viewBox="0 0 48 48" aria-hidden="true">
                <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.64,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.251-2.221,4.156-4.084,5.571l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
            </svg>
            
            <span class="tracking-tight">Lanjutkan dengan Google</span>
        </a>

        {{-- Tautan Pintasan Kembali ke Landing Page --}}
        <a href="{{ route('home') }}" 
           class="flex w-full items-center justify-center gap-2 py-2.5 text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 group/back">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transform group-hover/back:-translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            
            Kembali ke Beranda
        </a>
    </div>
</div>