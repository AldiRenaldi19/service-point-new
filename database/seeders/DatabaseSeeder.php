<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * * Membuat akun Super Admin utama secara aman dengan memanfaatkan
     * variabel lingkungan (.env) guna mencegah kebocoran kredensial di repositori git.
     */
    public function run(): void
    {
        // Mengecek apakah akun admin dengan email tersebut sudah ada untuk menghindari duplikasi
        $adminEmail = env('ADMIN_INITIAL_EMAIL', 'adminservice@servicepoint.com');

        if (! User::where('email', $adminEmail)->exists()) {

            // Mengambil password dari .env, jika tidak ada maka otomatis mengacak password aman
            $securePassword = env('ADMIN_INITIAL_PASSWORD', Str::random(16));

            User::create([
                'name' => env('ADMIN_INITIAL_NAME', 'Main Super Admin'),
                'email' => $adminEmail,
                'password' => Hash::make($securePassword),
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]);

            // Menampilkan informasi password acak di terminal jika diproduksi secara otomatis
            if (! env('ADMIN_INITIAL_PASSWORD')) {
                $this->command->info("⚠️ PERINGATAN: Password .env tidak ditemukan.");
                $this->command->info("Akun Admin berhasil dibuat dengan Password Acak: {$securePassword}");
            }
        }
    }
}
