<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * Menampilkan Daftar Katalog Produk Aktif
     * * Memanfaatkan Query Scope 'active()' untuk menjamin produk non-aktif terisolasi dari publik.
     */
    public function index(Request $request): View
    {
        // Memanfaatkan Scope 'active' dari model Product.php untuk efisiensi kueri database
        $query = Product::active();

        // Fitur Pencarian Kata Kunci (Terisolasi Parameterized AND/OR Grouping)
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';

            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm);
            });
        }

        // Fitur Filter Berdasarkan Kategori Spesifik
        if ($request->filled('category') && $request->category !== 'Semua') {
            $query->where('category', $request->category);
        }

        // Eksekusi Paginasi Aman (12 Items per Halaman)
        $products = $query->paginate(12);

        return view('pages.catalog', compact('products'));
    }
}
