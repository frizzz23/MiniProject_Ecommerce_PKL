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
    public function index(Request $request){
        
        

        // Mengambil keranjang hanya untuk pengguna yang sedang login
        $carts = Cart::where('user_id', Auth::id())->get();

        // Mengambil kategori dengan batas tertentu
        $categories = Category::withCount('products')->orderBy('products_count', 'desc')->take(6)->get();

        // Mengambil produk terbaru dengan gambar
        $products = Product::latest()->get();

        return view('landing-page', compact('categories', 'products', 'carts'));
    }
}
