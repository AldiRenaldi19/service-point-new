@extends('layouts.app')

@section('content')
    {{-- 1. HERO SECTION --}}
    <header class="relative bg-blue-950 py-16 md:py-36 px-4 overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10 grid md:grid-cols-2 gap-10 items-center">
            {{-- Mobile Video --}}
            <div class="block md:hidden relative mb-8">
                <div class="absolute -inset-4 bg-blue-500/20 blur-2xl rounded-full"></div>
                <video autoplay muted loop playsinline class="relative rounded-[2rem] shadow-2xl border-4 border-white/5 animate-float object-cover h-[250px] w-full" alt="Workshop">
                    <source src="https://res.cloudinary.com/dhh9v8fbw/video/upload/q_auto/f_auto/v1778851274/product_pvemne.mov" type="video/mp4">
                </video>
            </div>

            <div class="text-white text-center md:text-left">
                <div class="inline-flex items-center gap-2 bg-blue-900/50 border border-blue-700 px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest text-blue-200 mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative h-2 w-2 rounded-full bg-amber-500"></span>
                    </span>
                    Top1 Service Point
                </div>
                <h1 class="text-5xl md:text-8xl font-black leading-none tracking-tighter">
                    SERVICE POINT <br> <span class="text-amber-400 italic font-serif">AUTO CARE.</span>
                </h1>
                <p class="mt-6 text-blue-200 text-sm md:text-lg max-w-md mx-auto md:mx-0 leading-relaxed">
                    Solusi perawatan kendaraan kelas profesional dengan teknologi diagnosa terkini di Jatiasih.
                </p>
                <div class="mt-10 flex flex-wrap justify-center md:justify-start gap-4">
                    <a href="https://wa.me/6287884323768" target="_blank" class="w-full md:w-auto bg-green-500 text-white px-12 py-5 rounded-2xl font-black flex items-center justify-center gap-3 transition hover:scale-105 shadow-2xl shadow-green-500/30 uppercase tracking-wider">
                        <i class="fa-brands fa-whatsapp text-2xl"></i> Booking Sekarang
                    </a>
                </div>
            </div>

            {{-- Desktop Video --}}
            <div class="hidden md:block relative">
                <div class="absolute -inset-4 bg-blue-500/20 blur-3xl rounded-full"></div>
                <video autoplay muted loop playsinline class="relative rounded-[3rem] shadow-2xl border-8 border-white/5 animate-float object-cover h-[500px] w-full" alt="Workshop Hero">
                    <source src="https://res.cloudinary.com/dhh9v8fbw/video/upload/q_auto/f_auto/v1778851274/product_pvemne.mov" type="video/mp4">
                </video>
            </div>
        </div>
    </header>

    {{-- 2. STATS SECTION --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center reveal">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-award text-xl"></i>
                </div>
                <div class="text-4xl font-black text-blue-950 mb-2">10+</div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Tahun Pengalaman</div>
            </div>
            <div class="text-center reveal" style="transition-delay: 0.1s;">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-box-open text-xl"></i>
                </div>
                <div class="text-4xl font-black text-blue-950 mb-2">100%</div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Suku Cadang Ori</div>
            </div>
            <div class="text-center reveal" style="transition-delay: 0.2s;">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-microchip text-xl"></i>
                </div>
                <div class="text-4xl font-black text-blue-950 mb-2">HI-TECH</div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Scanner Diagnosa</div>
            </div>
            <div class="text-center reveal" style="transition-delay: 0.3s;">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-user-gear text-xl"></i>
                </div>
                <div class="text-4xl font-black text-blue-950 mb-2">PRO</div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Mekanik Ahli</div>
            </div>
        </div>
    </section>

    {{-- 3. LAYANAN UTAMA --}}
    <section id="services" class="py-24 bg-slate-50 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6 reveal">
                <div>
                    <h2 class="text-4xl md:text-6xl font-black text-blue-950 uppercase italic tracking-tighter leading-none">Layanan Utama</h2>
                    <p class="text-slate-500 mt-4 max-w-sm">Perawatan berkala mendalam untuk performa kendaraan maksimal.</p>
                </div>
                <div class="hidden md:block h-px flex-1 bg-slate-200 mx-12 mb-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                {{-- Engine --}}
                <div class="space-y-6 reveal">
                    <h3 class="flex items-center gap-3 text-blue-600 font-black uppercase tracking-widest text-sm">
                        <span class="w-8 h-px bg-blue-600"></span> Engine Performance
                    </h3>
                    <div class="group bg-white p-8 rounded-[2rem] shadow-xl border border-slate-100 hover:-translate-y-2 transition-all duration-300">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition">
                            <i class="fa-solid fa-bolt-lightning text-2xl"></i>
                        </div>
                        <h4 class="font-black text-xl text-blue-950 mb-3">Tune Up Plus</h4>
                        <p class="text-sm text-slate-500 leading-relaxed italic">Tune Up Carbon Cleaner membersihkan bagian dalam mesin agar lebih hemat BBM.</p>
                    </div>
                </div>

                {{-- Salon --}}
                <div class="space-y-6 reveal" style="transition-delay: 0.1s;">
                    <h3 class="flex items-center gap-3 text-amber-500 font-black uppercase tracking-widest text-sm">
                        <span class="w-8 h-px bg-amber-500"></span> Premium Detailing
                    </h3>
                    <div class="group bg-white p-8 rounded-[2rem] shadow-xl border border-slate-100 hover:-translate-y-2 transition-all duration-300">
                        <div class="w-14 h-14 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-amber-500 group-hover:text-white transition">
                            <i class="fa-solid fa-wand-magic-sparkles text-2xl"></i>
                        </div>
                        <h4 class="font-black text-xl text-blue-950 mb-3">Salon Mobil Lengkap</h4>
                        <p class="text-sm text-slate-500 leading-relaxed italic">Poles interior, body, & kaca. <span class="text-amber-600 font-bold block mt-2">FREE CUCI MOBIL</span></p>
                    </div>
                </div>

                {{-- Chassis --}}
                <div class="space-y-6 reveal" style="transition-delay: 0.2s;">
                    <h3 class="flex items-center gap-3 text-emerald-600 font-black uppercase tracking-widest text-sm">
                        <span class="w-8 h-px bg-emerald-600"></span> Chassis & Drive
                    </h3>
                    <div class="group bg-white p-8 rounded-[2rem] shadow-xl border border-slate-100 hover:-translate-y-2 transition-all duration-300">
                        <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition">
                            <i class="fa-solid fa-truck-monster text-2xl"></i>
                        </div>
                        <h4 class="font-black text-xl text-blue-950 mb-3">Spooring & Balancing</h4>
                        <p class="text-sm text-slate-500 leading-relaxed italic">Kalibrasi sudut roda presisi untuk kenyamanan dan kestabilan berkendara.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. PROSES KERJA (VIDEO GALLERY) --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16 reveal">
                <span class="text-blue-600 font-black uppercase tracking-[0.3em] text-xs">Our Expertise In Action</span>
                <h2 class="text-4xl md:text-6xl font-black text-blue-950 uppercase italic tracking-tighter mt-4 leading-none">Proses Kerja <br> <span class="text-blue-700 underline decoration-amber-400">Transparan.</span></h2>
                <p class="text-slate-500 mt-6 max-w-2xl mx-auto italic text-sm md:text-base">Dokumentasi asli pengerjaan unit di workshop kami oleh tim mekanik berpengalaman.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <div class="col-span-2 row-span-2 relative group rounded-[2rem] overflow-hidden shadow-2xl reveal bg-slate-200">
                    <video autoplay muted loop playsinline class="w-full h-full object-cover scale-110 group-hover:scale-100 transition duration-700">
                        <source src="https://res.cloudinary.com/dhh9v8fbw/video/upload/q_auto/f_auto/v1778850027/tuneup_ozj0q9.mov" type="video/mp4">
                    </video>
                    <div class="absolute bottom-8 left-8 z-20">
                        <span class="bg-amber-400 text-blue-950 text-[10px] font-black px-3 py-1 rounded-full uppercase mb-2 inline-block">Service Video</span>
                        <h4 class="text-white font-black text-2xl italic uppercase tracking-tighter">Bongkar & Maintenance</h4>
                    </div>
                </div>
                {{-- Small Videos --}}
                <div class="relative group rounded-[2rem] overflow-hidden shadow-xl h-[200px] md:h-[300px] reveal" style="transition-delay: 0.1s;">
                    <video autoplay muted loop playsinline class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <source src="https://res.cloudinary.com/dhh9v8fbw/video/upload/q_auto/f_auto/v1778850058/car-wash_trozpi.mov" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-950/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                        <p class="text-white text-[10px] font-bold uppercase tracking-widest">Detailing Interior</p>
                    </div>
                </div>
                <div class="relative group rounded-[2rem] overflow-hidden shadow-xl h-[200px] md:h-[300px] reveal" style="transition-delay: 0.2s;">
                    <video autoplay muted loop playsinline class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <source src="https://res.cloudinary.com/dhh9v8fbw/video/upload/q_auto/f_auto/v1778850101/maintenance_x7kerb.mov" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-950/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                        <p class="text-white text-[10px] font-bold uppercase tracking-widest">Pengecekan Roda</p>
                    </div>
                </div>
                <div class="col-span-2 relative group rounded-[2rem] overflow-hidden isolate shadow-xl h-[200px] md:h-[300px] reveal" style="transition-delay: 0.3s;">
                    <video autoplay muted loop playsinline class="w-full h-full object-cover rounded-[2rem] group-hover:scale-105 transition duration-500">
                        <source src="https://res.cloudinary.com/dhh9v8fbw/video/upload/q_auto/f_auto/v1778850114/workshop-action_nlth5y.mov" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-blue-900/20 mix-blend-multiply opacity-0 group-hover:opacity-100 transition"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-white border-2 border-white px-8 py-3 rounded-full font-black uppercase text-xs opacity-0 group-hover:opacity-100 transition translate-y-4 group-hover:translate-y-0 duration-500">
                            Professional Workshop Action
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. TOP 1 PARTNER & PRODUCTS --}}
    <section class="py-24 bg-slate-900 overflow-hidden border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between mb-20 gap-8 reveal">
                <div class="text-center md:text-left">
                    <h2 class="text-amber-400 text-5xl md:text-7xl font-black italic uppercase tracking-tighter leading-none">Official <br> <span class="text-white">TOP 1 Partner.</span></h2>
                    <p class="text-slate-400 mt-4 max-w-md italic">Menyediakan pelumas standar dunia untuk performa mesin yang tak tertandingi.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-xl p-8 rounded-[3rem] border border-white/10 flex items-center gap-6">
                    <img src="{{ asset('assets/img/top1.jpg') }}" class="h-20 md:h-28 grayscale brightness-200 hover:grayscale-0 transition duration-500 cursor-pointer" alt="TOP 1">
                    <div class="h-16 w-px bg-white/20"></div>
                    <div class="text-white">
                        <p class="text-2xl font-black italic uppercase leading-none">USA</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Quality Standards</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 reveal">
                @forelse($featured_products as $product)
                    <div class="bg-white group rounded-[2.5rem] p-6 transition-all duration-500 hover:shadow-[0_0_50px_-10px_rgba(251,191,36,0.3)] border border-slate-100 overflow-hidden relative text-left flex flex-col h-full">
                        <div class="absolute top-6 right-6 z-10">
                            <span class="{{ $product->stock > 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-600' }} text-[9px] font-black px-3 py-1 rounded-full uppercase tracking-tighter">
                                {{ $product->stock > 0 ? 'Ready: '.$product->stock.' pcs' : 'Out of Stock' }}
                            </span>
                        </div>
                        <div class="h-48 mb-6 flex items-center justify-center relative bg-slate-50 rounded-[2rem] overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="h-full w-full object-contain p-4 group-hover:scale-110 transition duration-500" alt="{{ $product->name }}">
                            @endif
                        </div>
                        <div class="flex-1 flex flex-col">
                            <span class="text-blue-600 text-[10px] font-black uppercase tracking-[0.2em]">{{ $product->category ?? 'Sparepart' }}</span>
                            <h4 class="font-black text-blue-950 uppercase text-lg leading-tight mt-1 line-clamp-2">{{ $product->name }}</h4>
                            <div class="mt-4 bg-slate-50 rounded-xl p-3 border border-slate-100">
                                <p class="text-[10px] text-slate-400 uppercase font-black mb-1 tracking-widest">Spesifikasi</p>
                                <p class="text-slate-600 text-xs italic leading-relaxed line-clamp-2">{{ $product->spec ?? 'Spesifikasi standar bengkel.' }}</p>
                            </div>
                        </div>
                        <div class="mt-auto pt-5 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-xl font-black text-blue-700 italic">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <a href="https://wa.me/6287884323768?text=Halo%20Service%20Point,%20saya%20tanya%20stok%20{{ urlencode($product->name) }}" target="_blank" class="w-12 h-12 bg-blue-950 text-white rounded-2xl flex items-center justify-center hover:bg-green-500 shadow-lg transition-all">
                                <i class="fa-brands fa-whatsapp text-xl"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center text-white italic">Produk belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 6. LAYANAN LAINNYA --}}
    <section class="py-20 bg-blue-950 text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-black uppercase italic tracking-widest mb-12 text-blue-400">Daftar Layanan Lainnya</h2>
            <div class="flex flex-wrap justify-center gap-4">
                @php
                    $other_services = ['Servis Mesin / Umum', 'Scan Diagnosa Hi-Tech', 'Cuci Mesin Plus Formula', 'Kuras Oli Matic', 'Servis AC Mobil', 'Cek Kaki-Kaki', 'Anti Karat Bagian Bawah', 'Cuci Ban Lepas (Detail)', 'Body Repair & Paint', 'Snow Wash / Hidrolik', 'Engine Repair', 'Kuras Minyak Rem', 'Ganti Kampas Rem', 'Ganti Kopling', 'Overhaul Mesin', 'Kuras Radiator', 'Ganti Aki & Elektrikal'];
                @endphp
                @foreach($other_services as $item)
                    <div class="px-6 py-4 bg-blue-900/40 border border-blue-800 rounded-2xl text-[10px] md:text-xs font-bold uppercase tracking-widest hover:bg-amber-400 hover:text-blue-950 transition duration-300">
                        {{ $item }}
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 7. LOCATION SECTION --}}
    <section id="location" class="py-24 bg-white px-4">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-20 items-center">
            <div class="reveal">
                <span class="text-blue-600 font-black uppercase tracking-[0.3em] text-xs">Find Our Workshop</span>
                <h2 class="text-5xl md:text-7xl font-black text-blue-950 uppercase italic tracking-tighter mt-4 mb-10 leading-none">Workshop <br> Jatiasih.</h2>
                <div class="space-y-10">
                    <div class="flex gap-8 group">
                        <div class="shrink-0 w-16 h-16 bg-slate-100 text-blue-600 rounded-3xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition duration-500">
                            <i class="fa-solid fa-location-dot text-2xl"></i>
                        </div>
                        <div>
                            <h5 class="font-black text-xl text-blue-950 italic uppercase">Alamat Utama</h5>
                            <p class="text-slate-500 text-sm italic font-medium">Jl. Raya Jatimekar No.339, Jatimekar, Kec. Jatiasih, Kota Bekasi, Jawa Barat 17422.</p>
                            <a href="https://maps.app.goo.gl/riK815qucryaJADX8" class="inline-block mt-4 text-xs font-black text-blue-600 border-b-2 border-blue-600 pb-1">PETUNJUK ARAH →</a>
                        </div>
                    </div>
                    <div class="flex gap-8 group">
                        <div class="shrink-0 w-16 h-16 bg-slate-100 text-emerald-600 rounded-3xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition duration-500">
                            <i class="fa-solid fa-clock text-2xl"></i>
                        </div>
                        <div>
                            <h5 class="font-black text-xl text-blue-950 italic uppercase">Jam Operasional</h5>
                            <p class="text-slate-500 text-sm mt-2 font-bold text-blue-900">Senin - Minggu: 08.00 — 17.00</p>
                            <p class="text-[10px] font-black text-red-600 uppercase tracking-widest mt-2">Khusus Jumat: Libur</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal relative" style="transition-delay: 0.2s;">
                <div class="bg-white p-4 rounded-[3rem] shadow-2xl rotate-2 hover:rotate-0 transition duration-700">
                    <div class="bg-slate-200 w-full h-[300px] md:h-[450px] rounded-[2.5rem] overflow-hidden grayscale hover:grayscale-0 transition duration-700">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7930471129152!2d106.95278261134312!3d-6.290909093671841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698db4045fa0b9%3A0x7cf2f5979d9ffe7a!2sService%20point!5e0!3m2!1sid!2sus!4v1778855579249!5m2!1sid!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection