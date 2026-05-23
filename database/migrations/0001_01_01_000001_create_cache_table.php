<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * * Membuat infrastruktur penyimpanan cache dan sistem atomic locking
     * untuk mengoptimalkan performa kueri aplikasi Service Point.
     */
    public function up(): void
    {
        // ==========================================
        // 1. SYSTEM CACHE TABLE
        // ==========================================
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        // ==========================================
        // 2. CACHE LOCKS TABLE (ATOMIC LOCKS)
        // ==========================================
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     * * Menghapus tabel cache dan cache_locks secara bersih saat rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
    }
};
