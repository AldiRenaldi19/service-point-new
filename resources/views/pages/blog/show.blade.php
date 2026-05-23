@extends('layouts.app')

@section('title', $post->title . ' | Service Point')

@section('content')
<article class="bg-white min-h-screen pb-20">
    
    {{-- ==========================================
         1. HERO SECTION
         Banner visual utama detail artikel.
         ========================================== --}}
    <div class="relative h-[50vh] md:h-[70vh] w-full overflow-hidden bg-blue-950">
        @if($post->thumbnail)
            <img src="{{ asset('storage/' . $post->thumbnail) }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-full object-cover opacity-85">
        @endif
        
        {{-- Layer Gradasi Penggelap Gambar --}}
        <div class="absolute inset-0 bg-gradient-to-t from-blue-950 via-blue-950/40 to-transparent"></div>
        
        {{-- Konten Teks di Atas Hero --}}
        <div class="absolute bottom-0 left-0 w-full p-6 md:p-20 z-10">
            <div class="max-w-4xl mx-auto">
                {{-- Tombol Navigasi Mundur --}}
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-white/70 hover:text-white text-[10px] font-black uppercase tracking-[0.2em] mb-6 transition">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Blog
                </a>
                
                {{-- Judul Artikel Utama --}}
                <h1 class="text-3xl md:text-6xl font-black text-white tracking-tighter uppercase italic leading-tight mb-6">
                    {{ $post->title }}
                </h1>
                
                {{-- Metadata Artikel --}}
                <div class="flex items-center gap-6 text-white/60 text-[10px] font-bold uppercase tracking-widest">
                    <span><i class="fa-solid fa-user text-blue-400 mr-2"></i> {{ $post->user->name }}</span>
                    <span><i class="fa-solid fa-calendar text-blue-400 mr-2"></i> {{ $post->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>


    {{-- ==========================================
         2. CORE CONTENT AREA
         Tempat render isi video dan teks tulisan blog.
         ========================================== --}}
    <div class="max-w-4xl mx-auto px-6 py-12 md:py-20">
        
        {{-- PRIORITAS UTAMA: Tampilan Video YouTube / MP4 Lokal di Bagian Atas Teks --}}
        @if($post->video_url)
            <div class="mb-12 rounded-3xl overflow-hidden shadow-2xl reveal bg-black">
                @php
                    $videoId = '';
                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $post->video_url, $match)) {
                        $videoId = $match[1];
                    }
                @endphp
                
                @if($videoId)
                    <div class="aspect-video">
                        <iframe class="w-full h-full" 
                                src="https://www.youtube.com/embed/{{ $videoId }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <a href="{{ $post->video_url }}" target="_blank" class="block p-10 text-white font-bold text-center bg-blue-950 hover:bg-blue-900 transition-colors">
                        <i class="fa-brands fa-youtube text-4xl mb-3 block text-red-500"></i>
                        Tonton Video di YouTube <i class="fa-solid fa-external-link ml-2 text-xs"></i>
                    </a>
                @endif
            </div>
        @elseif($post->video_file)
            <div class="mb-12 rounded-3xl overflow-hidden shadow-2xl reveal bg-black">
                <video class="w-full aspect-video" controls>
                    <source src="{{ asset('storage/' . $post->video_file) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endif

        {{-- Artikel Utama (Render HTML Editor) --}}
        <div class="prose prose-slate prose-lg max-w-none 
            prose-headings:font-black prose-headings:uppercase prose-headings:tracking-tighter prose-headings:italic prose-headings:text-blue-950
            prose-p:text-slate-600 prose-p:leading-relaxed
            prose-strong:text-blue-950
            prose-a:text-blue-700 prose-a:font-bold hover:prose-a:text-blue-950
            prose-img:rounded-3xl prose-img:shadow-lg
            reveal">
            {!! $post->content !!}
        </div>

        {{-- OPSI SEKUNDER: Menampilkan MP4 Lokal di Bawah Jika YouTube Sudah Mengisi Slot Atas --}}
        @if($post->video_url && $post->video_file)
            <div class="mt-16 pt-10 border-t border-slate-100">
                <h3 class="text-blue-950 font-black uppercase italic tracking-tighter mb-6 text-xl">
                    <i class="fa-solid fa-clapperboard mr-2 text-blue-400"></i> Video Terkait
                </h3>
                <div class="rounded-3xl overflow-hidden shadow-2xl reveal bg-black">
                    <video class="w-full aspect-video" controls>
                        <source src="{{ asset('storage/' . $post->video_file) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        @endif


        {{-- ==========================================
             3. FOOTER CONTENT & SOCIAL SHARE
             ========================================== --}}
        <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-8 reveal">
            {{-- Tombol Berbagi Medsos --}}
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bagikan:</span>
                
                {{-- Share Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                   target="_blank" rel="noopener noreferrer" 
                   class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-blue-600 hover:text-white transition-all shadow-sm"
                   aria-label="Bagikan ke Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>

                {{-- Share X / Twitter --}}
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" 
                   target="_blank" rel="noopener noreferrer" 
                   class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-black hover:text-white transition-all shadow-sm"
                   aria-label="Bagikan ke X">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>

                {{-- Share WhatsApp --}}
                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . request()->fullUrl()) }}" 
                   target="_blank" rel="noopener noreferrer" 
                   class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-green-500 hover:text-white transition-all shadow-sm"
                   aria-label="Bagikan ke WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </div>

            {{-- Pintasan Navigasi Tambahan --}}
            <a href="{{ route('katalog') }}" class="group bg-slate-50 text-blue-950 px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-950 hover:text-white transition-all duration-300 shadow-sm hover:shadow-xl w-full sm:w-auto text-center">
                Lihat Katalog Produk 
                <i class="fa-solid fa-chevron-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

    </div>
</article>
@endsection