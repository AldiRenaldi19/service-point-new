@extends('layouts.app')

@section('title', $post->title . ' | Service Point')

@section('content')
<article class="bg-white min-h-screen pb-20">
    {{-- Hero Section --}}
    <div class="relative h-[50vh] md:h-[70vh] w-full overflow-hidden">
        @if($post->thumbnail)
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-blue-950"></div>
        @endif
        
        <div class="absolute inset-0 bg-gradient-to-t from-blue-950 via-blue-950/20 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 w-full p-6 md:p-20">
            <div class="max-w-4xl mx-auto">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-white/70 hover:text-white text-[10px] font-black uppercase tracking-[0.2em] mb-6 transition">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Blog
                </a>
                <h1 class="text-3xl md:text-6xl font-black text-white tracking-tighter uppercase italic leading-none mb-6">
                    {{ $post->title }}
                </h1>
                <div class="flex items-center gap-6 text-white/60 text-[10px] font-bold uppercase tracking-widest">
                    <span><i class="fa-solid fa-user text-blue-400 mr-2"></i> {{ $post->user->name }}</span>
                    <span><i class="fa-solid fa-calendar text-blue-400 mr-2"></i> {{ $post->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 py-16 md:py-24">
        
        {{-- TOP VIDEO AREA: YouTube Priority --}}
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
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @else
                    <a href="{{ $post->video_url }}" target="_blank" class="block p-10 text-white font-bold text-center bg-blue-950 hover:bg-blue-900 transition">
                        <i class="fa-brands fa-youtube text-4xl mb-3 block text-red-500"></i>
                        Tonton Video di YouTube <i class="fa-solid fa-external-link ml-2"></i>
                    </a>
                @endif
            </div>
        @elseif($post->video_file)
            {{-- MP4 naik ke atas kalau YouTube kosong --}}
            <div class="mb-12 rounded-3xl overflow-hidden shadow-2xl reveal bg-black">
                <video class="w-full aspect-video" controls>
                    <source src="{{ asset('storage/' . $post->video_file) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endif

        {{-- Main Article Content --}}
        <div class="prose prose-slate prose-lg max-w-none 
            prose-headings:font-black prose-headings:uppercase prose-headings:tracking-tighter prose-headings:italic prose-headings:text-blue-950
            prose-p:text-slate-600 prose-p:leading-relaxed
            prose-strong:text-blue-950
            prose-img:rounded-3xl prose-img:shadow-lg
            reveal">
            {!! $post->content !!}
        </div>

        {{-- BOTTOM VIDEO AREA: MP4 as Secondary Content --}}
        @if($post->video_url && $post->video_file)
            <div class="mt-16 pt-8 border-t border-slate-100">
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

        {{-- Footer Content: Social Share & CTA --}}
        <div class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-8 reveal">
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bagikan:</span>
                
                {{-- Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                    target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-blue-600 hover:text-white transition-all">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>

                {{-- X --}}
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" 
                    target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-black hover:text-white transition-all">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>

                {{-- WhatsApp --}}
                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . request()->fullUrl()) }}" 
                    target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-green-500 hover:text-white transition-all">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </div>

            <a href="{{ route('katalog') }}" class="group bg-slate-50 text-blue-950 px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-950 hover:text-white transition-all duration-300 shadow-sm hover:shadow-xl">
                Lihat Katalog Produk 
                <i class="fa-solid fa-chevron-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</article>
@endsection