<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query dengan produk yang aktif saja
        $query = Product::where('is_active', true);

        // Fitur Search (Nama ATAU Deskripsi)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Fitur Filter Kategori
        // Menggunakan filled() lebih aman daripada has() karena ngecek null/kosong
        if ($request->filled('category') && $request->category !== 'Semua') {
            $query->where('category', $request->category);
        }

        // Ambil data dengan pagination (12 produk per halaman)
        // latest() supaya produk terbaru muncul di atas
        $products = $query->latest()->paginate(12);

        // Pastikan path view sesuai dengan lokasi file lo (tadi kita bahas katalog.blade.php)
        // Kalau lo simpan di resources/views/katalog.blade.php, pakai 'katalog'
        return view('pages.catalog', compact('products'));
    }
}
