@extends('layouts.app')

@section('title', 'Artikel & Tips Otomotif | Service Point')

@section('content')
<div class="bg-slate-50 min-h-screen pt-10 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="text-center mb-16 reveal">
            <h2 class="text-[10px] font-black tracking-[0.3em] text-blue-700 uppercase mb-4">Wawasan Berkendara</h2>
            <h1 class="text-4xl md:text-5xl font-black text-blue-950 tracking-tighter italic uppercase leading-tight">
                Blog & <span class="text-blue-700">Artikel.</span>
            </h1>
            <p class="mt-4 text-slate-500 max-w-2xl mx-auto text-sm leading-relaxed">
                Temukan tips perawatan kendaraan, update teknologi otomotif terbaru, dan cerita eksklusif dari balik bengkel Service Point.
            </p>
        </div>

        {{-- Grid Artikel --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($posts as $post)
            <article class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-slate-100 group hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-2 transition-all duration-500 reveal flex flex-col">
                
                {{-- Image Area --}}
                <div class="relative h-64 overflow-hidden">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" 
                            alt="{{ $post->title }}" 
                            class="w-full h-full object-cover group-hover:scale-110 transition-all duration-1000">
                    @else
                        <div class="w-full h-full bg-slate-200 flex items-center justify-center">
                            <i class="fa-solid fa-image text-slate-400 text-4xl"></i>
                        </div>
                    @endif
                    
                    {{-- Badge Tanggal --}}
                    <div class="absolute top-6 left-6">
                        <span class="bg-white/90 backdrop-blur-md text-blue-950 text-[9px] font-black px-4 py-2 rounded-xl uppercase tracking-widest shadow-sm">
                            {{ $post->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>

                {{-- Content Area --}}
                <div class="p-8 flex flex-col flex-grow">
                    <h3 class="text-xl font-black text-blue-950 mb-4 leading-tight group-hover:text-blue-700 transition-colors duration-300 italic uppercase tracking-tighter">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    
                    <p class="text-slate-500 text-sm line-clamp-3 mb-8 leading-relaxed">
                        {{ Str::limit(strip_tags($post->content), 130) }}
                    </p>
                    
                    {{-- Footer Card --}}
                    <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-blue-950 text-white flex items-center justify-center font-black text-[11px] shadow-lg shadow-blue-900/20">
                                {{ substr($post->user->name, 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[10px] font-black text-blue-950 uppercase tracking-wider">{{ $post->user->name }}</span>
                                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">Author</span>
                            </div>
                        </div>

                        <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-50 text-blue-700 hover:bg-blue-700 hover:text-white transition-all duration-300 group/btn">
                            <i class="fa-solid fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-newspaper text-slate-300 text-3xl"></i>
                </div>
                <h3 class="text-blue-950 font-black uppercase tracking-tighter text-xl mb-2">Belum ada konten</h3>
                <p class="text-slate-400 text-sm">Nantikan update menarik dari kami segera!</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-20">
            {{ $posts->links() }}
        </div>

    </div>
</div>
@endsection