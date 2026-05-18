<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'brand',
        'spec',
        'description',
        'fungsi',
        'manfaat',
        'price',
        'stock',
        'image',
        'is_active',
    ];

    protected $guarded = [];
}
