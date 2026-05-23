<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * * Membuat fondasi tabel pengguna, sistem token reset sandi, 
     * serta manajemen sesi autentikasi aplikasi Service Point.
     */
    public function up(): void
    {
        // ==========================================
        // 1. SYSTEM USERS TABLE
        // ==========================================
        Schema::create('users', function (Blueprint $table) {
            // Primary Key & Informasi Autentikasi Dasar
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            // Diperbolehkan Kosong (Nullable) Karena Mendukung Jalur Google Sign-In
            $table->string('password')->nullable();

            // Komponen Tambahan Ekstensi Google Auth & Filament Roles
            $table->string('google_id')->nullable()->unique();
            $table->string('avatar')->nullable();
            $table->string('role')->default('customer'); // Nilai Default Diubah Menjadi 'customer' Demi Keamanan Pendaftaran Mandiri

            // Struktur Bawaan Laravel Framework
            $table->rememberToken();
            $table->timestamps();
        });

        // ==========================================
        // 2. PASSWORD RESET TOKENS TABLE
        // ==========================================
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // ==========================================
        // 3. DATABASE SESSIONS TABLE
        // ==========================================
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     * * Menghapus seluruh tabel sistem jika perintah rollback dijalankan.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
