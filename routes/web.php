<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Halaman Home
Route::get('/', function () {
    $featured_products = Product::where('is_active', true)
        ->latest()
        ->take(3)
        ->get();

    return view('pages.home', compact('featured_products'));
})->name('home');

// Halaman Tentang Kami
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Halaman Katalog
Route::get('/katalog', function (Request $request) {
    $query = Product::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category') && $request->category != 'Semua') {
        $query->where('category', $request->category);
    }

    $products = $query->where('is_active', true)
        ->latest()
        ->paginate(12);

    return view('pages.catalog', compact('products'));
})->name('katalog');

// Halaman Blog / Artikel
Route::get('/blog', function () {
    $posts = \App\Models\Post::where('status', true) // Hanya yang published
        ->latest()
        ->paginate(9);
    return view('pages.blog.index', compact('posts'));
})->name('blog.index');

// Halaman Detail Artikel
Route::get('/blog/{slug}', function ($slug) {
    $post = \App\Models\Post::where('slug', $slug)
        ->where('status', true)
        ->firstOrFail();
    return view('pages.blog.show', compact('post'));
})->name('blog.show');

// Halaman Detail Produk
Route::get('/katalog/{slug}', function ($slug) {
    $product = Product::where('slug', $slug)
        ->orWhere('id', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    return view('pages.product-detail', compact('product'));
})->name('product.detail');

// Halaman auth Google
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

/*
|--------------------------------------------------------------------------
| Filament Admin (Otomatis)
|--------------------------------------------------------------------------
*/
// Filament v3 secara otomatis berjalan di /admin melalui AdminPanelProvider.