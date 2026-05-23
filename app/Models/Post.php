<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * * Keamanan Mass Assignment: Hanya kolom di bawah ini yang boleh diisi
     * secara massal melalui request massal (Form/Payload HTTP).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'video_url',
        'video_file',
        'status',
    ];

    /**
     * The attributes that should be cast.
     * * Data Casting Protection: Memaksa konversi tipe data saat dibaca dari database
     * untuk mencegah manipulasi tipe data bertipe string/integer liar oleh pihak luar.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean', // Memastikan nilai selalu murni true/false (0/1)
        'user_id' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | 1. SYSTEM RELATIONSHIPS (RELASI DATABASE)
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi ke User (Penulis / Author)
     * * Menghubungkan setiap artikel blog dengan akun staf/admin yang memproduksinya.
     * * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | 2. BUSINESS UTILITY HELPER METHODS (AKSESOR / LOGIKA INTERNAL)
    |--------------------------------------------------------------------------
    | Kumpulan metode pembantu untuk menjaga Controller tetap kurus (Skinny).
    | Logika pemanggilan aset gambar/video diletakkan di sini agar seragam.
    |
    */

    /**
     * Mengambil URL Thumbnail Aman
     * * Mencegah error 'broken image' di sisi client dan memastikan path asset 
     * terisolasi dengan benar melalui sistem Storage Laravel.
     *
     * @return string
     */
    public function getThumbnailUrl(): string
    {
        if ($this->thumbnail && Storage::disk('public')->exists($this->thumbnail)) {
            return Storage::url($this->thumbnail);
        }

        // Fallback gambar default jika thumbnail kosong atau file fisik terhapus
        return asset('assets/img/top1.jpg');
    }

    /**
     * Mengambil URL Berkas Video Lokal Aman
     * * Memastikan pemanggilan aset video MP4 lokal tervalidasi keberadaan filenya.
     *
     * @return string|null
     */
    public function getVideoFileUrl(): ?string
    {
        if ($this->video_file && Storage::disk('public')->exists($this->video_file)) {
            return Storage::url($this->video_file);
        }

        return null;
    }

    /**
     * Scope Query: Hanya Artikel yang Sudah Rilis (Published)
     * * Hacker Protection: Mencegah kebocoran draf artikel rahasia melalui manipulasi parameter URL.
     * Cukup panggil `Post::published()->get()` di Controller.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', true)->latest();
    }
}
