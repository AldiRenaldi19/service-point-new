<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * * Membuat infrastruktur tabel testimonials untuk menampung ulasan pelanggan,
     * penilaian performa servis, serta status penayangan testimoni di Service Point.
     */
    public function up(): void
    {
        // ==========================================
        // 1. CORE TESTIMONIALS TABLE
        // ==========================================
        Schema::create('testimonials', function (Blueprint $table) {
            // Kunci Utama & Relasi Akun Pengguna (Opsional)
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // Profil & Identitas Pelanggan
            $table->string('name');
            $table->string('car'); // Menyimpan data tipe/merek kendaraan pelanggan

            // Isi Ulasan & Sistem Penilaian (Rating)
            $table->text('content');
            $table->unsignedTinyInteger('stars')->default(5); // Nilai rating 1 sampai 5

            // Kontrol Manajemen Penayangan
            $table->boolean('is_active')->default(true); // true = Ditampilkan di Landing Page

            // Jejak Waktu Sistem
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * * Menghapus tabel testimonials secara bersih saat rollback dijalankan.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
