# Service Point - Professional Auto Care Platform

<p align="center">
    <a href="https://sajutaberkah.my.id" target="_blank">
        <span style="font-size: 2em; font-weight: 900; font-style: italic; color: #1e3a8a; text-transform: uppercase;">SERVICE <span style="color: #1d4ed8;">POINT.</span></span>
    </a>
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-11.x-ED5B5B?style=for-the-badge&logo=laravel" alt="Laravel Version">
    <img src="https://img.shields.io/badge/Filament-v3.x-F59E0B?style=for-the-badge&logo=laravel" alt="Filament Version">
    <img src="https://img.shields.io/badge/Tailwind_CSS-v4.0-06B6D4?style=for-the-badge&logo=tailwind-css" alt="Tailwind CSS">
    <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php" alt="PHP Version">
</p>

---

## 🛠️ Tentang Service Point

**Service Point** adalah platform sistem informasi dan manajemen bengkel modern (_Professional Auto Care_) yang berlokasi di Jatiasih, Bekasi. Platform ini berfungsi sebagai beranda utama interaksi pelanggan sekaligus sistem manajemen internal (_back-office_) bengkel yang terintegrasi penuh. Platform ini juga merupakan sistem kemitraan resmi selaku **Official TOP 1 Partner**.

### 🌟 Fitur Utama

1. **Multi-Panel Back-office (Filament v3)**:
   - **`Dashboard Admin (/admin)`**: Panel manajemen penuh untuk `super_admin` and `admin` dalam mengelola resource, konfigurasi sistem, dan inventori global.
   - **`Dashboard Staff (/app)`**: Panel operasional harian yang dikhususkan bagi pengguna dengan role `staff`.
2. **Katalog Produk Dinamis**:
   - Menampilkan daftar produk oli (_Genuine Parts & Oils_), suku cadang, dan aksesoris.
   - Filter kategori interaktif (_All_, _Oli Mesin_, _Suku Cadang_, _Aksesoris_) dan fitur pencarian (_live-search_) berbasis nama/deskripsi.
   - Dilengkapi penanganan _Rich Text Editor Content_ dengan kompilasi raw HTML aman (`{!! !!}`).
3. **Sistem Otentikasi Terintegrasi (Laravel Socialite)**:
   - Login instan satu klik menggunakan akun Google (**Google OAuth**).
   - Penanganan _Session Regeneration_ yang aman untuk deployment _production / hosting shared_.
   - Manajemen _Intended Redirect Path_ otomatis yang mengarahkan pengguna secara dinamis ke panel yang sesuai berdasarkan role di database (`super_admin`/`admin` -> `/admin`, `staff` -> `/app`).
4. **Integrasi WhatsApp Booking**:
   - Penghubung instan ke admin bengkel menggunakan _URL encoding text template_ otomatis berdasarkan nama produk yang dipilih oleh pelanggan.
5. **Manajemen Berkas Skala Besar**:
   - Dukungan optimasi unggah media gambar produk beresolusi tinggi hingga **20MB** terkonfigurasi via enkapsulasi _file upload schema middleware_.

---

## 🚀 Spesifikasi Teknologi

- **Framework Utama**: Laravel 11.x
- **Tampilan Administrasi**: Filament v3 (Multipanel Architecture)
- **Sistem CSS**: Tailwind CSS
- **Otentikasi Pihak Ketiga**: Laravel Socialite (Google Driver)
- **Kompilasi Icon & Font**: FontAwesome v6.5.1 & Google Fonts Poppins

---

## 💻 Instalasi Lokal & Pengembangan

Ikuti langkah-langkah di bawah ini untuk menjalankan project Service Point di lingkungan lokal Anda (misal: macOS menggunakan Laravel Herd / Docker, atau Windows menggunakan XAMPP):

### 1. Kloning Repositori

```bash
git clone https://github.com/AldiRenaldi19/service-point-new.git
cd service-point-new
```

### 2. Pasang Dependensi Composer & NPM

```bash
# Pasang dependensi PHP
composer install

# Pasang dependensi JavaScript/CSS
npm install
```

### 3. Konfigurasi Environment File

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database dan Google OAuth Anda di dalam `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=service_point
DB_USERNAME=root
DB_PASSWORD=

# Konfigurasi Google OAuth (Socialite)
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Jalankan Migrasi, Database Seeder & Storage Link

```bash
# Jalankan migrasi database beserta data awal (seeder)
php artisan migrate --seed

# Hubungkan folder storage agar gambar produk dapat diakses publik
php artisan storage:link
```

### 6. Membuat Akun Akses Panel (Filament User)

Jika Anda ingin membuat akun admin baru secara manual untuk masuk ke back-office, jalankan perintah berikut:

```bash
php artisan make:filament-user
```

_Ikuti instruksi di terminal untuk mengisi nama, email, dan password._

### 7. Jalankan Server Lokal & Kompilasi Aset

Jalankan perintah ini di dua tab terminal terpisah:

```bash
# Terminal 1: Jalankan server Laravel
php artisan serve

# Terminal 2: Jalankan compiler aset untuk Tailwind CSS
npm run dev
```

Aplikasi sekarang dapat diakses melalui browser di alamat `http://127.0.0.1:8000`.

---

## 🌐 Catatan Deployment (Hosting/Shared cPanel)

Jika Anda melakukan deployment pada server _Shared Hosting_ (seperti Domainesia), pastikan parameter pembatasan php diatur untuk mengakomodasi pengunggahan berkas besar di atas 5MB:

1. Masuk ke **cPanel** -> **Select PHP Version** -> Tab **Options**.
2. Ubah nilai parameter berikut minimal menjadi:
   - `upload_max_filesize` = `32M` atau `64M`
   - `post_max_size` = `32M` atau `64M`
3. Pastikan Anda melakukan build aset produksi terlebih dahulu sebelum mendeploy:
   ```bash
   npm run build
   ```
4. Jalankan perintah pembersihan cache global melalui terminal hosting setelah melakukan pembaruan kode:
   ```bash
   php artisan optimize:clear
   php artisan filament:clear-cached-components
   ```

---

## 🔒 Lisensi

Project ini bersifat proprietary dan dikembangkan khusus untuk operasional internal **Service Point Pro Auto Care**.

```
Thanks For Attention
```
