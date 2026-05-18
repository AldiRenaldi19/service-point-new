<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Mengambil URL Avatar untuk Filament
     */
    public function getFilamentAvatarUrl(): ?string
    {
        if (!$this->avatar) {
            return null;
        }

        // Jika avatar adalah URL (hasil login Google), langsung kembalikan
        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }

        // Jika avatar adalah path file (hasil upload manual), gunakan Storage
        return Storage::url($this->avatar);
    }

    /**
     * Logic akses panel Filament
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Cek Akses Panel Admin
        if ($panel->getId() === 'admin') {
            return in_array($this->role, ['admin', 'super_admin']);
        }

        // Cek Akses Panel User (App)
        if ($panel->getId() === 'app') {
            return true;
        }

        return false;
    }
}
