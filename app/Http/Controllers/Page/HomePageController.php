<?php

namespace App\Http\Controllers\Page;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index(Request $request)
{
    $carts = Cart::where('user_id', Auth::id())->get();

    $categories = Category::paginate(6);

    $allCategories = Category::all();

    $productsByCategory = [];
    foreach ($allCategories as $category) {
        $product = Product::where('category_id', $category->id)
            ->withCount('reviews') // Menghitung jumlah review
            ->withAvg('reviews as average_rating', 'rating') // Menghitung rata-rata rating
            ->orderByDesc('average_rating')
            ->orderByDesc('reviews_count')
            ->first();

        if ($product) {
            $productsByCategory[] = $product;
        }
    }

    // Ambil semua produk dengan rata-rata rating dan jumlah review
    $products = Product::withCount('reviews') // Menghitung jumlah review
        ->withAvg('reviews as average_rating', 'rating') // Menghitung rata-rata rating
        ->get();

    // Data untuk produk paling banyak dipesan
    $mostOrderedProducts = Product::withCount(['productOrders', 'reviews']) // Tambahkan reviews count
    ->orderByDesc('product_orders_count')
    ->withAvg('reviews as average_rating', 'rating')
    ->take(3)
    ->get();

$mostPopularProduct1 = $mostOrderedProducts->get(0) ?? null;
$mostPopularProduct2 = $mostOrderedProducts->get(1) ?? null;
$mostPopularProduct3 = $mostOrderedProducts->get(2) ?? null;


$latestProducts = Product::withCount(['reviews']) // Menghitung jumlah review
->withAvg('reviews as average_rating', 'rating') // Menambahkan rata-rata rating
->orderBy('created_at', 'desc')
->take(2)
->get();

$produkbaru1 = $latestProducts->get(0) ?? null;
$produkbaru2 = $latestProducts->get(1) ?? null;


    return view('landing-page', compact(
        'categories',
        'products',
        'carts',
        'productsByCategory',
        'mostOrderedProducts',
        'mostPopularProduct1',
        'mostPopularProduct2',
        'mostPopularProduct3',
        'produkbaru1',
        'produkbaru2'
    ));
}

}
