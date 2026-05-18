@extends('layouts.app')

@section('content')
{{-- Tambahkan style khusus untuk menghandle konten dari RichEditor --}}
<style>
    .rich-content img {
        max-width: 100%;
        height: auto;
        border-radius: 1.5rem;
        margin: 1.5rem 0;
        display: block;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .rich-content figcaption {
        display: none !important;
    }
    .rich-content .attachment__metadata {
        display: none !important;
    }
    .rich-content ul { list-style-type: disc; margin-left: 1.5rem; }
    .rich-content ol { list-style-type: decimal; margin-left: 1.5rem; }
    .rich-content a { color: #fbbf24; text-decoration: underline; }
</style>

<div class="bg-slate-50 min-h-screen pt-32 pb-20 px-4">
    <div class="max-w-7xl mx-auto">
        
        {{-- Breadcrumb --}}
        <nav class="flex mb-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
            <a href="{{ route('katalog') }}" class="hover:text-blue-600 transition">Katalog</a>
            <span class="mx-3 text-slate-300">/</span>
            <span class="text-blue-600 italic">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            {{-- Image Section --}}
            <div class="relative group">
                <div class="bg-white rounded-[3rem] p-12 border border-slate-100 shadow-2xl shadow-slate-200/60 flex items-center justify-center overflow-hidden h-[400px] md:h-[550px] sticky top-32">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                            class="h-full w-full object-contain group-hover:scale-105 transition duration-700" 
                            alt="{{ $product->name }}">
                    @else
                        <i class="fa-solid fa-image text-[120px] text-slate-100"></i>
                    @endif

                    {{-- Floating Badge --}}
                    <div class="absolute bottom-8 right-8">
                        @if($product->stock > 0)
                            <div class="bg-emerald-500 text-white px-6 py-2 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg">
                                Stock Ready: {{ $product->stock }}
                            </div>
                        @else
                            <div class="bg-red-500 text-white px-6 py-2 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg">
                                Out of Stock
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Info Section --}}
            <div class="space-y-8">
                <div class="text-left">
                    <span class="text-blue-600 font-black text-xs uppercase tracking-[0.4em] mb-3 block">
                        {{ $product->category }}
                    </span>
                    <h1 class="text-5xl md:text-7xl font-black text-blue-950 uppercase italic tracking-tighter leading-[0.9] mb-6">
                        {{ $product->name }}
                    </h1>
                    
                    <div class="inline-flex flex-wrap items-center gap-4 bg-white p-2 pr-6 rounded-3xl border border-slate-100 shadow-sm">
                        <div class="bg-blue-950 text-amber-400 px-6 py-3 rounded-2xl italic font-black text-3xl shadow-inner">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                        @if($product->brand)
                            <div class="text-left">
                                <p class="text-[9px] text-slate-400 uppercase font-black tracking-widest">Brand Partner</p>
                                <p class="text-blue-950 font-black uppercase text-sm italic">{{ $product->brand }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Features Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:border-blue-200 transition text-left">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 mb-4">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </div>
                        <h5 class="text-blue-950 font-black text-xs uppercase tracking-widest mb-2">Fungsi Utama</h5>
                        <p class="text-slate-500 text-xs italic leading-relaxed">
                            {{ $product->fungsi ?? 'Menjaga performa mesin tetap stabil dan optimal dalam berbagai kondisi penggunaan.' }}
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:border-amber-200 transition text-left">
                        <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 mb-4">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h5 class="text-blue-950 font-black text-xs uppercase tracking-widest mb-2">Manfaat</h5>
                        <p class="text-slate-500 text-xs italic leading-relaxed">
                            {{ $product->manfaat ?? 'Meningkatkan durabilitas komponen dan efisiensi bahan bakar kendaraan Anda.' }}
                        </p>
                    </div>
                </div>

                {{-- Full Description --}}
                <div class="bg-blue-950 rounded-[3rem] p-8 md:p-10 text-white relative overflow-hidden text-left">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-900/30 -translate-y-32 translate-x-32 rounded-full blur-3xl"></div>
                    
                    <div class="relative z-10">
                        <h5 class="text-amber-400 font-black text-xs uppercase tracking-[0.3em] mb-6 flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-amber-400"></span> Detail Deskripsi
                        </h5>
                        
                        <div class="rich-content text-blue-100 text-sm md:text-base leading-relaxed italic space-y-4">
                            @if($product->description)
                                {!! $product->description !!}
                            @else
                                <p>Produk ini merupakan suku cadang original yang telah melewati uji standarisasi pabrikan untuk menjamin keamanan dan kenyamanan berkendara.</p>
                            @endif
                        </div>

                        <div class="mt-8 pt-8 border-t border-blue-900/50">
                            <h5 class="text-white font-black text-xs uppercase tracking-widest mb-4 italic">Spesifikasi Teknis:</h5>
                            <div class="bg-blue-900/40 rounded-2xl p-5 border border-blue-800">
                                <p class="text-blue-200 text-xs font-mono leading-relaxed">
                                    {{ $product->spec ?? 'Technical specifications not specified.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="https://wa.me/6287884323768?text=Halo%20Service%20Point,%20saya%20ingin%20tanya%20detail%20produk:%20{{ urlencode($product->name) }}" 
                        target="_blank"
                        class="flex-[2] bg-green-500 text-white px-8 py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-green-600 hover:scale-[1.02] transition-all duration-300 shadow-xl shadow-green-500/25 flex items-center justify-center gap-3">
                        <i class="fa-brands fa-whatsapp text-2xl"></i> Hubungi via WhatsApp
                    </a>
                    <a href="{{ route('katalog') }}" 
                        class="flex-1 bg-white text-blue-950 px-8 py-5 rounded-2xl font-black uppercase tracking-widest border-2 border-blue-950 hover:bg-blue-950 hover:text-white transition-all duration-300 flex items-center justify-center">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection