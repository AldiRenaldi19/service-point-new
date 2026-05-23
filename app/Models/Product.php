<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     * * Keamanan Mass Assignment: Mencegah injeksi kolom tak dikenal.
     * * CATATAN: properti '$guarded = []' telah dihapus karena bertabrakan dengan '$fillable'.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'category',
        'brand',
        'spec',
        'description',
        'fungsi',
        'manfaat',
        'image',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | HELPER METHODS & QUERY SCOPES (LOGIKA INTERNAL)
    |--------------------------------------------------------------------------
    */

    /**
     * Mengambil URL Gambar Produk Aman
     *
     * @return string
     */
    public function getImageUrl(): string
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }

        return asset('assets/img/top1.jpg');
    }

    /**
     * Scope Query: Hanya Produk Aktif
     * * Hacker Protection: Mencegah manipulasi URL untuk melihat katalog produk non-aktif.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->latest();
    }
}
