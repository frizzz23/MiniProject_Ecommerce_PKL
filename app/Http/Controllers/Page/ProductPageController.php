<?php

namespace App\Http\Controllers\Page;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Error;
use Illuminate\Support\Facades\Auth;

class ProductPageController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        // Validasi input dan ambil data kategori, brand, harga, dll.
        $validated = $request->validate([
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0|gte:min_price',
        ], [
            'min_price.numeric' => 'Harga minimal harus berupa angka.',
            'min_price.min' => 'Harga minimal tidak boleh kurang dari 0.',
            'max_price.numeric' => 'Harga maksimal harus berupa angka.',
            'max_price.min' => 'Harga maksimal tidak boleh kurang dari 0.',
            'max_price.gte' => 'Harga maksimal tidak boleh lebih kecil dari harga minimal.',
        ]);

        // Ambil data kategori, brand, dan filter pencarian
        $categories = Category::all();
        $brands = Brand::all();
        $search = $request->get('search');
        $selectedCategory = $request->input('Category');
        $selectedCategories = $request->input('categories', []);
        $selectedBrand = $request->input('Brand');
        $selectedBrands = $request->input('Brands', []);
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sortOrder = $request->input('sort_order', 'terbaru');
        $sortPrice = $request->input('sort_price');

        // Ambil produk yang difilter berdasarkan kategori, harga, dan pengurutan
        $products = Product::with('category', 'productOrders') // Pastikan relasi 'productOrders' ada di sini
            ->when($search, function ($query, $search) {
                return $query->where('name_product', 'like', '%' . $search . '%');
            })
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->where('category_id', $selectedCategory);
            })
            ->when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
                return $query->whereIn('category_id', $selectedCategories);
            })
            ->when($selectedBrand, function ($query) use ($selectedBrand) {
                return $query->where('brand_id', $selectedBrand);
            })
            ->when(!empty($selectedBrands), function ($query) use ($selectedBrands) {
                return $query->whereIn('brand_id', $selectedBrands);
            })
            ->when($minPrice, function ($query) use ($minPrice) {
                return $query->where('price_product', '>=', $minPrice);
            })
            ->when($maxPrice, function ($query) use ($maxPrice) {
                return $query->where('price_product', '<=', $maxPrice);
            })
            ->when($sortOrder, function ($query) use ($sortOrder) {
                if ($sortOrder === 'terlama') {
                    return $query->orderBy('created_at', 'asc');
                }
                return $query->orderBy('created_at', 'desc');
            })
            ->when($sortPrice, function ($query) use ($sortPrice) {
                if ($sortPrice === 'rendah') {
                    return $query->orderBy('price_product', 'asc');
                } elseif ($sortPrice === 'tinggi') {
                    return $query->orderBy('price_product', 'desc');
                }
                return $query;
            })
            ->get();

        // Menghitung rata-rata rating dan jumlah produk terjual
        foreach ($products as $product) {
            // Rata-rata rating
            $product->average_rating = Review::where('product_id', $product->id)
                ->avg('rating');

            // Menghitung jumlah produk terjual menggunakan relasi 'productOrders'
            $product->sold_count = $product->productOrders->sum('quantity'); // Pastikan 'quantity' ada di tabel OrderDetail
        }

        // Menghitung jumlah review per produk
        $reviewsCount = [];
        foreach ($products as $product) {
            $reviewsCount[$product->id] = Review::where('product_id', $product->id)->count();
        }

        $codes = PromoCode::all();

        // Return ke view dengan data produk, kategori, jumlah review, dan jumlah produk terjual
        return view('page.product', compact('products', 'categories', 'reviewsCount', 'search', 'minPrice', 'maxPrice', 'sortOrder', 'sortPrice', 'brands', 'codes'));
    }



    /**
     * Display the specified product.
     */
    /**
     * Display the specified product.
     */
    public function show(Request $request, $slug)
{
    // Gunakan slug untuk mencari produk
    $product = Product::with('reviews.user')->where('slug', $slug)->firstOrFail();

    // Menghitung rata-rata rating untuk produk yang dipilih
    $averageRating = Review::where('product_id', $product->id)
        ->avg('rating') ?: 0; // Set default rating 0 jika tidak ada review

    // Menghitung jumlah review untuk produk yang dipilih
    $reviewsCount = Review::where('product_id', $product->id)->count();

    // Mengambil semua review untuk produk yang dipilih
    $reviews = Review::where('product_id', $product->id)->get();

    // Mengambil produk lain dengan kategori yang sama
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id) // Menghindari produk yang sedang dilihat
        ->get();

    // Menghitung rata-rata rating untuk setiap produk terkait
    foreach ($relatedProducts as $relatedProduct) {
        $relatedProduct->average_rating = Review::where('product_id', $relatedProduct->id)
            ->avg('rating') ?: 0; // Set default rating 0 jika tidak ada review
    }

    // Menghitung jumlah review per produk terkait
    $relatedReviewsCount = [];
    foreach ($relatedProducts as $relatedProduct) {
        $relatedReviewsCount[$relatedProduct->id] = Review::where('product_id', $relatedProduct->id)->count();
    }

    // Menghitung jumlah produk yang terjual
    $productOrdersCount = $product->productOrders->sum('quantity'); // Asumsikan ada relasi 'productOrders'

    $user = Auth::user();

    // Controller code

$allowedReviews = collect();
$existingReviews = collect();

if ($user) {
    // Ambil semua order completed dari user untuk produk ini
    $completedOrders = Order::where('user_id', $user->id)
        ->where('status_order', 'completed')
        ->whereHas('productOrders', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })
        ->with('productOrders') // eager load product orders
        ->get();

    foreach ($completedOrders as $order) {
        // Cek apakah review sudah ada untuk order ini
        $review = Review::where([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'order_id' => $order->id
        ])->first();

        if ($review) {
            $existingReviews->push([
                'review' => $review,
                'order' => $order,
                'review_given' => true // Tandai bahwa review sudah diberikan
            ]);
        } else {
            // Cek jumlah item dalam order ini
            $orderQuantity = $order->productOrders
                ->where('product_id', $product->id)
                ->sum('quantity');

            $allowedReviews->push([
                'order' => $order,
                'quantity' => $orderQuantity,
                'review_given' => false // Tandai bahwa review belum diberikan
            ]);
        }
    }
}

// Tampilkan view dengan data produk, rating, jumlah review, jumlah produk terjual, dan produk terkait
return view('page.productshow', compact(
    'allowedReviews',
    'existingReviews',
    'product',
    'reviews',
    'averageRating',
    'reviewsCount',
    'relatedProducts',
    'relatedReviewsCount',
    'productOrdersCount'
));
}




public function addReview(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'order_id' => 'required|exists:orders,id',
        'rating' => 'required|in:1,2,3,4,5',
        'comment' => 'required|string|max:1000',
    ]);

    // Verifikasi order
    $order = Order::where('id', $request->order_id)
        ->where('user_id', Auth::id())
        ->where('status_order', 'completed')
        ->firstOrFail();

    // Cek apakah review sudah ada
    $existingReview = Review::where([
        'order_id' => $request->order_id,
        'product_id' => $request->product_id,
        'user_id' => Auth::id()
    ])->first();

    if ($existingReview) {
        return response()->json(['success' => false, 'message' => 'Anda sudah memberikan review untuk order ini.']);
    }

    // Simpan review baru
    $review = Review::create([
        'user_id' => Auth::id(),
        'product_id' => $request->product_id,
        'order_id' => $request->order_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return response()->json(['success' => true, 'message' => 'Review berhasil ditambahkan.', 'review' => $review]);
}





    /**
     * Handle the incoming request (used as a fallback).
     */
}
