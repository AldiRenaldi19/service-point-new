<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * * Membuat infrastruktur tabel posts untuk mengelola manajemen artikel,
     * publikasi blog, serta distribusi materi video pada aplikasi Service Point.
     */
    public function up(): void
    {
        // ==========================================
        // 1. CORE POSTS / ARTICLES TABLE
        // ==========================================
        Schema::create('posts', function (Blueprint $table) {
            // Kunci Utama & Relasi Penulis (Author)
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Inti Konten Artikel
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');

            // Manajemen Media Visual & Video Terkait
            $table->string('thumbnail')->nullable();
            $table->string('video_url')->nullable();  // Menyimpan tautan eksternal (YouTube)
            $table->string('video_file')->nullable(); // Menyimpan path berkas lokal (MP4)

            // Kontrol Manajemen Publikasi Admin
            $table->boolean('status')->default(false); // false = Draft, true = Published

            // Jejak Waktu Sistem
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * * Menghapus tabel posts secara bersih saat rollback dijalankan.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
