<?php

namespace App\Models;

use Filament\Panel;
use Illuminate\Support\Str;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * PHP 8.2+ Method Style Casting.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | 1. FILAMENT ADVANCED INTEGRATION (CORE CONTROL)
    |--------------------------------------------------------------------------
    */

    /**
     * Mengambil URL Avatar untuk Filament
     * Memeriksa validitas penyimpanan fisik maupun tautan eksternal dari Google Auth.
     */
    public function getFilamentAvatarUrl(): ?string
    {
        if (! $this->avatar) {
            return null;
        }

        // Jalur Google Sign-In (URL Utuh dari Google API)
        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }

        // 🛠️ CRITICAL FIX: Memastikan pengambilan URL menggunakan disk 'public' yang sama dengan pengecekan fisik file
        if (Storage::disk('public')->exists($this->avatar)) {
            return Storage::disk('public')->url($this->avatar);
        }

        return null;
    }

    /**
     * Logic Akses Otorisasi Panel Filament
     * Hacker Protection (Privilege Escalation): Membatasi gerak role tertentu di panel yang salah.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        $panelId = $panel->getId();

        // 1. Gerbang Panel Administrasi Utama (Back-Office)
        if ($panelId === 'admin') {
            return in_array($this->role, ['super_admin', 'admin'], true);
        }

        // 2. Gerbang Panel Aplikasi Pelanggan & Operasional (Front-Office)
        if ($panelId === 'app') {
            return in_array($this->role, ['staff', 'customer', 'super_admin', 'admin'], true);
        }

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | 2. SYSTEM RELATIONSHIPS (RELASI DATABASE)
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi ke model Testimonial
     */
    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    /*
    |--------------------------------------------------------------------------
    | 3. AUTHENTICATION & SECURITY MUTATORS
    |--------------------------------------------------------------------------
    */

    /**
     * Pengecekan Cepat Status Super Admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * 🛡️ SAFE STORAGE HOOK (Mutator)
     * Mencegah Laravel merusak data string/null password pada user hasil registrasi Google OAuth
     * ketika ada proses pembaruan data massal (mass assignment).
     */
    public function setPasswordAttribute($value): void
    {
        if (empty($value)) {
            // Jika dikosongkan dan user ini mendaftar pakai Google, buat password acak aman di latar belakang
            $this->attributes['password'] = $this->google_id ? $this->attributes['password'] ?? bcrypt(Str::random(16)) : null;
        } else {
            $this->attributes['password'] = $value;
        }
    }
}
