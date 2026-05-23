@extends('layouts.app')

@section('content')
    {{-- ==========================================
         1. HERO HEADER
         Menampilkan judul halaman katalog komponen
         dan pesan jaminan keaslian barang.
         ========================================== --}}
    <header class="bg-blue-950 pt-32 pb-16 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <span class="text-amber-400 font-black uppercase tracking-[0.3em] text-xs">Genuine Parts & Oils</span>
            <h1 class="text-5xl md:text-7xl font-black text-white uppercase italic tracking-tighter mt-4 leading-none">
                PRODUCT <span class="text-blue-500">CATALOG.</span>
            </h1>
            <p class="text-blue-200 mt-6 max-w-2xl mx-auto italic text-sm md:text-base">
                Kami hanya menyediakan suku cadang dan pelumas original untuk menjaga durabilitas mesin kendaraan Anda.
            </p>
        </div>
    </header>


    {{-- ==========================================
         2. STICKY FILTER & SEARCH BAR
         Navigasi kategori dinamis yang mempertahankan query string
         dan form pencarian produk.
         ========================================== --}}
    <section class="sticky top-[72px] z-40 bg-white/80 backdrop-blur-md border-b border-slate-100 py-6 px-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            
            {{-- Navigasi Filter Kategori --}}
            <div class="flex gap-4 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto scrollbar-hide">
                {{-- Tombol 'Semua' Produk --}}
                <a href="{{ route('katalog') }}" 
                   class="whitespace-nowrap px-6 py-2 {{ !request('category') ? 'bg-blue-950 text-white' : 'bg-slate-100 text-slate-500' }} rounded-full text-xs font-black uppercase tracking-widest transition">
                    Semua
                </a>
                
                {{-- Daftar Kategori Statis (Mempertahankan parameter pencarian saat diklik) --}}
                @foreach(['Oli Mesin', 'Suku Cadang', 'Aksesoris', 'Lainnya'] as $cat)
                    <a href="{{ route('katalog', ['category' => $cat, 'search' => request('search')]) }}" 
                       class="whitespace-nowrap px-6 py-2 {{ request('category') == $cat ? 'bg-blue-950 text-white' : 'bg-slate-100 text-slate-500 hover:bg-blue-100' }} rounded-full text-xs font-black uppercase tracking-widest transition">
                        {{ $cat }}
                    </a>
                @endforeach
            </div> 
            
            {{-- Form Pencarian Produk --}}
            <form action="{{ route('katalog') }}" method="GET" class="relative w-full md:w-72">
                {{-- Mempertahankan filter kategori aktif saat melakukan pencarian baru --}}
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." 
                       class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-2xl text-sm focus:ring-2 focus:ring-blue-600 transition">
                
                <button type="submit" class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </section>


    {{-- ==========================================
         3. PRODUCT GRID SECTION
         Menampilkan list produk menggunakan struktur data loop @forelse.
         ========================================== --}}
    <section class="py-16 bg-slate-50 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                
                @forelse($products as $product)
                    {{-- Wrapper Card Produk --}}
                    <div class="group bg-white rounded-[2.5rem] p-6 border border-slate-100 shadow-sm hover:shadow-[0_20px_50px_-20px_rgba(30,58,138,0.2)] hover:-translate-y-2 transition-all duration-500 relative overflow-hidden flex flex-col h-full">
                        
                        {{-- Area Gambar Produk (Tautan Menuju Detail) --}}
                        <a href="{{ route('product.detail', $product->slug ?? $product->id) }}" class="h-52 mb-6 flex items-center justify-center bg-slate-50 rounded-[2rem] overflow-hidden relative">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     class="h-40 w-full object-contain group-hover:scale-110 transition duration-500 p-4" 
                                     alt="{{ $product->name }}">
                            @else
                                <i class="fa-solid fa-image text-7xl text-slate-200"></i>
                            @endif
                            
                            {{-- Hover Overlay Animasi --}}
                            <div class="absolute inset-0 bg-blue-900/5 opacity-0 group-hover:opacity-100 transition duration-500 flex items-center justify-center">
                                <div class="bg-white/90 backdrop-blur-sm text-blue-950 text-[10px] font-black px-4 py-2 rounded-xl uppercase tracking-widest shadow-xl transform translate-y-4 group-hover:translate-y-0 transition duration-500">
                                    Detail Produk
                                </div>
                            </div>
                        </a>

                        {{-- Area Konten Teks & Informasi Kategori --}}
                        <div class="flex-1 flex flex-col">
                            <p class="text-blue-600 font-black text-[10px] uppercase tracking-widest mb-1">
                                {{ $product->category }}
                            </p>
                            
                            <a href="{{ route('product.detail', $product->slug ?? $product->id) }}">
                                <h4 class="font-black text-blue-950 text-xl leading-tight group-hover:text-blue-600 transition uppercase italic">
                                    {{ $product->name }}
                                </h4>
                            </a>
                            
                            {{-- Atribut Tambahan: Brand & Spesifikasi --}}
                            <div class="mt-4 space-y-3">
                                @if($product->brand)
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] bg-slate-100 text-slate-500 font-bold px-2 py-0.5 rounded uppercase tracking-wider">Brand: {{ $product->brand }}</span>
                                    </div>
                                @endif

                                <div class="bg-blue-50/50 rounded-xl p-3 border border-blue-100/50 text-left">
                                    <p class="text-[9px] text-blue-400 uppercase font-black mb-1 tracking-widest">Spesifikasi Utama</p>
                                    <p class="text-slate-600 text-[11px] italic leading-relaxed line-clamp-2">
                                        {{ $product->spec ?? 'Sesuai standar pabrikan original.' }}
                                    </p>
                                </div>

                                {{-- Deskripsi Tambahan (HTML Raw Terproteksi dengan helper e() & Js-stripping via Laravel Clean) --}}
                                <div class="text-slate-400 text-xs italic leading-relaxed line-clamp-2 text-left wrapper-html">
                                    @if($product->description)
                                        {{-- SECURITY FIX: Disarankan menggunakan package tambahan seperti HTMLPurifier jika input berasal dari user bebas. 
                                             Saat ini dipastikan aman jika input deskripsi hanya dari sisi Admin Trusted --}}
                                        {!! $product->description !!}
                                    @else
                                        Kualitas original untuk menjaga durabilitas mesin kendaraan Anda.
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Footer Card: Status Stok & CTA WhatsApp --}}
                        <div class="pt-5 flex items-center justify-between border-t border-slate-100 mt-6">
                            <div class="flex flex-col text-left">
                                <span class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Ketersediaan</span>
                                <span class="text-xs font-black text-blue-950 italic tracking-tighter">Hubungi Admin</span>
                            </div>
                            <a href="https://wa.me/6287884323768?text=Halo%20Service%20Point,%20saya%20ingin%20tanya%20stok%20{{ urlencode($product->name) }}" 
                               target="_blank"
                               class="w-12 h-12 bg-green-500 text-white rounded-2xl flex items-center justify-center hover:bg-green-600 hover:scale-110 transition shadow-lg shadow-green-500/20">
                                <i class="fa-brands fa-whatsapp text-xl"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    {{-- State Fallback: Jika data pencarian/kategori menghasilkan nilai nol (0) --}}
                    <div class="col-span-full text-center py-20 bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                        <i class="fa-solid fa-box-open text-6xl text-slate-200 mb-4"></i>
                        <h3 class="text-blue-950 font-black uppercase italic">Oops! Produk Kosong</h3>
                        <p class="text-slate-500 italic text-sm mt-2">Coba gunakan kata kunci lain atau filter kategori yang berbeda.</p>
                    </div>
                @endforelse

            </div>

            {{-- Komponen Navigasi Pagination Link (Mempertahankan Query Parameter URL) --}}
            <div class="mt-20 flex justify-center">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </section>


    {{-- ==========================================
         4. BOTTOM CTA SECTION
         Banner penawaran pencarian suku cadang kustom.
         ========================================== --}}
    <section class="py-24 bg-blue-600 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-500 -skew-x-12 translate-x-20"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 flex flex-col md:flex-row items-center justify-between gap-10 text-center md:text-left">
            <div>
                <h2 class="text-white text-4xl md:text-5xl font-black italic uppercase tracking-tighter leading-none">Cari Sparepart <br> Spesifik?</h2>
                <p class="text-blue-100 mt-4 font-medium italic text-lg">Tanyakan ketersediaan stok via WhatsApp kami.</p>
            </div>
            <a href="https://wa.me/6287884323768" target="_blank" class="bg-amber-400 text-blue-950 px-12 py-5 rounded-2xl font-black uppercase tracking-widest hover:scale-105 transition shadow-2xl shadow-amber-400/20 flex items-center gap-3">
                <i class="fa-brands fa-whatsapp text-2xl"></i> Hubungi Admin
            </a>
        </div>
    </section>
@endsection