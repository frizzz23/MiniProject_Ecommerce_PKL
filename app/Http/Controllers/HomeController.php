<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $limit = 6;

        // Mengambil keranjang hanya untuk pengguna yang sedang login
        $carts = Cart::where('user_id', Auth::id())->get();

        // Mengambil kategori dengan batas tertentu
        $categories = Category::limit($limit)->get();

        // Mengambil produk terbaru dengan gambar
        $products = Product::with('images')->latest()->limit($limit)->get();

        return view('landing-page', compact('categories', 'products', 'limit', 'carts'));
    }

}
