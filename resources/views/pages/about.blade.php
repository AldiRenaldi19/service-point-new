@extends('layouts.app')

@section('content')
    {{-- ==========================================
         1. HEADER / HERO SECTION
         Menampilkan judul utama halaman About Us 
         ========================================== --}}
    {{-- 🛠️ FIX 1: Memastikan overflow-hidden bekerja ketat di mobile --}}
    <header class="relative bg-blue-950 py-20 md:py-32 px-4 overflow-hidden max-w-full">
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center">
                <span class="inline-block bg-amber-400 text-blue-950 text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-[0.2em] mb-6">
                    Our Story
                </span>
                <h1 class="text-5xl md:text-8xl font-black text-white leading-none tracking-tighter">
                    SERVICE POINT <br> 
                    <span class="text-amber-400 italic font-serif">TRUST & PRECISION.</span>
                </h1>
                <p class="mt-8 text-blue-200 text-sm md:text-lg max-w-2xl mx-auto leading-relaxed italic">
                    Lebih dari sekadar bengkel, kami adalah partner perjalanan Anda dalam memastikan performa kendaraan tetap berada di level tertinggi sejak hari pertama.
                </p>
            </div>
        </div>
        {{-- Elemen Dekoratif --}}
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-96 h-96 bg-blue-500/10 blur-[120px] rounded-full"></div>
    </header>


    {{-- ==========================================
         2. STATS SECTION
         Menampilkan pencapaian metrik utama bengkel.
         ========================================== --}}
    <section class="py-12 bg-white border-b border-slate-100 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                
                <div class="text-center reveal">
                    <div class="text-4xl font-black text-blue-950">5000+</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Unit Tertangani</div>
                </div>
                
                <div class="text-center reveal" style="transition-delay: 0.1s;">
                    <div class="text-4xl font-black text-blue-950">10+</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Tahun Pengalaman</div>
                </div>
                
                <div class="text-center reveal" style="transition-delay: 0.2s;">
                    <div class="text-4xl font-black text-blue-950">99%</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Kepuasan Pelanggan</div>
                </div>
                
                <div class="text-center reveal" style="transition-delay: 0.3s;">
                    <div class="text-4xl font-black text-blue-950">15+</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Mekanik Sertifikasi</div>
                </div>

            </div>
        </div>
    </section>


    {{-- ==========================================
         3. VISION & CORE VALUES SECTION
         Poin-poin landasan prinsip operasional kerja.
         ========================================== --}}
    {{-- 🛠️ FIX 2: Menambahkan overflow-hidden di sini agar bayangan dekoratif miring tidak membocorkan lebar layar di HP --}}
    <section class="py-24 bg-white px-4 overflow-hidden">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-20 items-center">
            
            {{-- Bagian Gambar Beraset --}}
            <div class="relative reveal px-2">
                {{-- 🛠️ FIX 3: Mengubah rotate-3 menjadi md:rotate-3 (efek miring hanya aktif di desktop agar tidak offscreen di HP) --}}
                <div class="absolute -inset-4 bg-slate-100 rounded-[3rem] -z-10 md:rotate-3"></div>
                <img src="{{ asset('assets/img/page.jpg') }}" 
                     class="rounded-[2.5rem] shadow-2xl grayscale hover:grayscale-0 transition duration-700 w-full h-[500px] object-cover" 
                     alt="Workshop Focus">
            </div>
            
            {{-- Teks Nilai Utama --}}
            <div class="reveal">
                <h2 class="text-4xl md:text-6xl font-black text-blue-950 uppercase italic tracking-tighter leading-none mb-8">
                    Visi Kami <br> 
                    <span class="text-blue-700 underline decoration-amber-400">Menjadi Standar.</span>
                </h2>
                
                <div class="space-y-8">
                    {{-- Nilai 1 --}}
                    <div class="flex gap-6">
                        <div class="shrink-0 w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center font-black">01</div>
                        <div>
                            <h4 class="font-black text-blue-950 uppercase text-lg mb-2 italic">Teknologi Tanpa Kompromi</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Kami terus berinvestasi pada scanner diagnosa terbaru dan peralatan modern untuk memastikan akurasi setiap pengerjaan.</p>
                        </div>
                    </div>
                    
                    {{-- Nilai 2 --}}
                    <div class="flex gap-6">
                        <div class="shrink-0 w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center font-black">02</div>
                        <div>
                            <h4 class="font-black text-blue-950 uppercase text-lg mb-2 italic">Integritas & Transparansi</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Di Jatimekar, apa yang Anda lihat adalah apa yang Anda dapatkan. Tidak ada biaya tersembunyi atau penggantian suku cadang yang tidak perlu.</p>
                        </div>
                    </div>
                    
                    {{-- Nilai 3 --}}
                    <div class="flex gap-6">
                        <div class="shrink-0 w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center font-black">03</div>
                        <div>
                            <h4 class="font-black text-blue-950 uppercase text-lg mb-2 italic">Edukasi Pelanggan</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Kami senang berbagi pengetahuan. Mekanik kami akan menjelaskan secara detail kondisi kendaraan Anda agar Anda bisa mengambil keputusan terbaik.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    {{-- ==========================================
         4. MISSION STATEMENT SECTION
         ========================================== --}}
    <section class="py-24 bg-blue-950 px-4 overflow-hidden relative">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-16 items-center">
            
            {{-- List Misi --}}
            <div class="md:w-1/2 reveal">
                <h2 class="text-white text-4xl md:text-5xl font-black uppercase italic tracking-tighter leading-none mb-8">
                    Misi Kami Untuk <br> 
                    <span class="text-amber-400">Dunia Otomotif.</span>
                </h2>
                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <i class="fa-solid fa-circle-check text-amber-400 mt-1"></i>
                        <p class="text-blue-100 text-sm leading-relaxed">Menyediakan solusi perawatan preventif yang memperpanjang usia pakai kendaraan pelanggan kami.</p>
                    </li>
                    <li class="flex items-start gap-4">
                        <i class="fa-solid fa-circle-check text-amber-400 mt-1"></i>
                        <p class="text-blue-100 text-sm leading-relaxed">Membangun ekosistem perbengkelan yang jujur dengan standar operasional prosedur (SOP) kelas dunia.</p>
                    </li>
                    <li class="flex items-start gap-4">
                        <i class="fa-solid fa-circle-check text-amber-400 mt-1"></i>
                        <p class="text-blue-100 text-sm leading-relaxed">Menjadi jembatan antara teknologi kendaraan terbaru dengan kemudahan akses servis bagi masyarakat Jatiasih.</p>
                    </li>
                </ul>
            </div>
            
            {{-- Kolom Video Grid Interaktif --}}
            <div class="md:w-1/2 grid grid-cols-2 gap-4 reveal" style="transition-delay: 0.2s;">
                <video autoplay muted loop playsinline class="rounded-3xl h-64 w-full object-cover">
                    <source src="{{ asset('assets/vid/product.mp4') }}" type="video/mp4">
                </video>
                <video autoplay muted loop playsinline class="rounded-3xl h-64 w-full object-cover mt-8">
                    <source src="{{ asset('assets/vid/product2.mp4') }}" type="video/mp4">
                </video>
            </div>

        </div>
    </section>


    {{-- ==========================================
         5. WHY US SECTION
         ========================================== --}}
    <section class="py-24 bg-slate-50 px-4 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6 reveal">
                <div>
                    <h2 class="text-4xl md:text-6xl font-black text-blue-950 uppercase italic tracking-tighter leading-none">Mengapa Pilih Kami?</h2>
                    <p class="text-slate-500 mt-4 max-w-sm">Dedikasi kami tercermin dari kepuasan ribuan pelanggan di Jatiasih and sekitarnya.</p>
                </div>
                <div class="hidden md:block h-px flex-1 bg-slate-200 mx-12 mb-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Keunggulan 1 --}}
                <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-slate-100 reveal">
                    <i class="fa-solid fa-medal text-4xl text-amber-500 mb-6"></i>
                    <h4 class="font-black text-2xl text-blue-950 uppercase mb-4 italic">Sertifikasi Ahli</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Tim mekanik kami memiliki sertifikasi resmi dan pelatihan berkala untuk menangani berbagai tipe mesin modern dan klasik.</p>
                </div>

                {{-- Keunggulan 2 --}}
                <div class="bg-blue-900 p-10 rounded-[3rem] shadow-xl text-white reveal" style="transition-delay: 0.1s;">
                    <i class="fa-solid fa-handshake-angle text-4xl text-amber-400 mb-6"></i>
                    <h4 class="font-black text-2xl uppercase mb-4 italic">Partner Resmi</h4>
                    <p class="text-blue-100 text-sm leading-relaxed">Sebagai partner resmi brand oli dunia seperti TOP 1, kami menjamin keaslian setiap cairan dan suku cadang yang masuk ke mesin Anda.</p>
                </div>

                {{-- Keunggulan 3 --}}
                <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-slate-100 reveal" style="transition-delay: 0.2s;">
                    <i class="fa-solid fa-microchip text-4xl text-blue-600 mb-6"></i>
                    <h4 class="font-black text-2xl text-blue-950 uppercase mb-4 italic">Fasilitas Lengkap</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Dari area tunggu yang nyaman hingga peralatan bongkar mesin yang lengkap, kami sediakan semuanya untuk Anda.</p>
                </div>
            </div>
        </div>
    </section>


    {{-- ==========================================
         6. ACADEMIC COLLABORATION SECTION
         ========================================== --}}
    <section class="py-24 bg-white px-4 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="bg-blue-950 rounded-[4rem] overflow-hidden relative shadow-2xl">
                <div class="grid md:grid-cols-2 items-center">
                    
                    {{-- Sisi Teks Keterangan --}}
                    <div class="p-12 md:p-20 reveal">
                        <span class="text-amber-400 font-bold uppercase tracking-widest text-xs">Digital Transformation</span>
                        <h2 class="text-4xl md:text-5xl font-black text-white uppercase italic tracking-tighter mt-4 leading-none">
                            Powered by <br> 
                            <span class="text-blue-400">Universitas Pelita Bangsa.</span>
                        </h2>
                        <p class="text-blue-100 mt-6 leading-relaxed italic text-sm md:text-base">
                            Platform digital ini merupakan hasil kolaborasi inovatif dan didukung oleh mahasiswa Teknik Informatika Universitas Pelita Bangsa untuk memodernisasi layanan otomotif di Indonesia melalui otomasi sistem informasi.
                        </p>
                        <div class="mt-10 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center border border-white/20">
                                <i class="fa-solid fa-graduation-cap text-amber-400 text-xl"></i>
                            </div>
                            <span class="text-white font-black uppercase text-xs tracking-widest">Inovasi Mahasiswa</span>
                        </div>
                    </div>

                    {{-- Sisi Cover Gambar Kolaborasi --}}
                    <div class="relative h-[400px] md:h-[600px] overflow-hidden reveal" style="transition-delay: 0.2s;">
                        <img src="{{ asset('assets/img/student-collaboration.jpeg') }}" 
                             class="absolute inset-0 w-full h-full object-cover transition duration-700 hover:scale-105" 
                             alt="Student Collaboration">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/40 to-transparent hidden md:block"></div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{-- ==========================================
         7. FINAL CALL TO ACTION (CTA) SECTION
         ========================================== --}}
    {{-- 🛠️ FIX 4: Menambahkan overflow-hidden di section terluar CTA --}}
    <section class="py-24 bg-white text-center px-4 overflow-hidden">
        <div class="max-w-4xl mx-auto bg-blue-950 p-12 md:p-20 rounded-[4rem] relative overflow-hidden shadow-2xl reveal">
            <div class="relative z-10">
                <h2 class="text-4xl md:text-6xl font-black text-white uppercase italic tracking-tighter leading-tight mb-8">
                    Siap Berikan Yang <br> 
                    <span class="text-amber-400">Terbaik</span> Untuk Mobil Anda?
                </h2>
                <a href="https://wa.me/6287884323768" target="_blank" class="inline-flex bg-green-500 text-white px-12 py-5 rounded-2xl font-black items-center gap-3 transition hover:scale-105 shadow-xl uppercase tracking-wider">
                    <i class="fa-brands fa-whatsapp text-2xl"></i> Hubungi Kami Sekarang
                </a>
            </div>
            {{-- Ornamen Latar Belakang --}}
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-blue-500/20 blur-[100px] rounded-full"></div>
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-amber-500/10 blur-[100px] rounded-full"></div>
        </div>
    </section>

    {{-- Kustomisasi Style Internal Khusus Animasi Entry --}}
    {{-- 🛠️ FIX 5: Menambahkan overflow-x-hidden pada elemen html/body di CSS khusus mobile jika diperlukan --}}
    <style>
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.9s cubic-bezier(0.17, 0.55, 0.55, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    {{-- Push Sisi Script Logika ke Layout Utama --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.15
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
    @endpush
@endsection