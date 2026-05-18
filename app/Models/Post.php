<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

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
     * Relasi ke User (Penulis)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
