<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * * Membuat infrastruktur tabel produk untuk mengelola inventaris,
     * spesifikasi, serta detail katalog komoditas pada aplikasi Service Point.
     */
    public function up(): void
    {
        // ==========================================
        // 1. CORE PRODUCTS TABLE
        // ==========================================
        Schema::create('products', function (Blueprint $table) {
            // Identitas Utama Produk
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('brand')->default('TOP 1');

            // Spesifikasi & Deskripsi Konten
            $table->string('spec')->nullable();
            $table->text('description')->nullable();
            $table->text('fungsi')->nullable();
            $table->text('manfaat')->nullable();

            // Tata Visual & Kontrol Status Manajemen
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);

            // Jejak Waktu Sistem
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * * Menghapus tabel produk secara bersih saat rollback dijalankan.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
