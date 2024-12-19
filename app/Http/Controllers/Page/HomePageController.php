<?php

namespace App\Http\Controllers\Page;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil keranjang hanya untuk pengguna yang sedang login
        $carts = Cart::where('user_id', Auth::id())->get();

        // Mengambil kategori tanpa limit, menggunakan paginate
        $categories = Category::paginate(6); // Ganti limit dengan paginate untuk kategori

        // Mengambil produk dengan relasi reviews, menghitung rata-rata rating, jumlah review, dan penjualan
        $products = Product::with('reviews') // Pastikan relasi reviews dimuat
            ->get() // Ambil semua produk
            ->map(function ($product) {
                // Menghitung rata-rata rating produk
                $product->averageRating = $product->reviews->avg('rating') ?? 0; // Menggunakan 0 jika tidak ada rating
                $product->reviewsCount = $product->reviews->count(); // Menghitung jumlah review
                $product->salesCount = $product->sales_count ?? 0; // Ambil jumlah penjualan produk
                return $product;
            })
            ->sortByDesc('averageRating'); // Mengurutkan berdasarkan rating tertinggi

        return view('landing-page', compact('categories', 'products', 'carts'));
    }
}
