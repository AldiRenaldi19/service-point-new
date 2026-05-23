<?php

use App\Models\Post;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;

/*
|--------------------------------------------------------------------------
| 1. SYSTEM WEB ROUTES (PUBLIC ACCESS)
|--------------------------------------------------------------------------
| Seluruh rute publik untuk landing page, katalog, testimoni,
| hingga sistem distribusi konten artikel blog Service Point.
|
*/

// --- LANDING PAGE (HOME) ---
Route::get('/', function () {
    $featured_products = Product::where('is_active', true)
        ->latest()
        ->take(3)
        ->get();

    $testimonials = Testimonial::latest()
        ->take(3)
        ->get();

    return view('pages.home', compact('featured_products', 'testimonials'));
})->name('home');

// --- TENTANG KAMI (ABOUT) ---
Route::get('/about', function () {
    return view('pages.about');
})->name('about');


/*
|--------------------------------------------------------------------------
| 2. CATALOGUE & PRODUCT MANAGEMENT SYSTEM
|--------------------------------------------------------------------------
*/

// --- INDEKS KATALOG PRODUK ---
Route::get('/katalog', function (Request $request) {
    $query = Product::query();

    // Penyaringan Berdasarkan Input Pencarian Kata Kunci
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Penyaringan Berdasarkan Kategori Spesifik
    if ($request->filled('category') && $request->category !== 'Semua') {
        $query->where('category', $request->category);
    }

    $products = $query->where('is_active', true)
        ->latest()
        ->paginate(12);

    return view('pages.catalog', compact('products'));
})->name('katalog');

// --- DETAIL INFORMASI PRODUK ---
Route::get('/katalog/{slug}', function ($slug) {
    $product = Product::where('is_active', true)
        ->where(function ($query) use ($slug) {
            $query->where('slug', $slug)
                ->orWhere('id', $slug);
        })
        ->firstOrFail();

    return view('pages.product-detail', compact('product'));
})->name('product.detail');


/*
|--------------------------------------------------------------------------
| 3. CONTENT DISTRIBUTION SYSTEM (BLOG & ARTICLES)
|--------------------------------------------------------------------------
*/

// --- INDEKS ARTIKEL BLOG ---
Route::get('/blog', function () {
    $posts = Post::where('status', true)
        ->latest()
        ->paginate(9);

    return view('pages.blog.index', compact('posts'));
})->name('blog.index');

// --- DETAIL BACA ARTIKEL BLOG ---
Route::get('/blog/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)
        ->where('status', true)
        ->firstOrFail();

    return view('pages.blog.show', compact('post'));
})->name('blog.show');


/*
|--------------------------------------------------------------------------
| 4. OAUTH INTEGRATION & THIRD-PARTY AUTHENTICATION
|--------------------------------------------------------------------------
*/

// --- GOOGLE OAUTH GATEWAY ---
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

/*
|--------------------------------------------------------------------------
| 5. FILAMENT ADMINISTRATIVE PANELS (AUTOMATIC)
|--------------------------------------------------------------------------
| Filament v3 secara otomatis mendaftarkan rute /admin dan /app 
| melalui berkas AdminPanelProvider dan AppPanelProvider masing-masing.
|
*/