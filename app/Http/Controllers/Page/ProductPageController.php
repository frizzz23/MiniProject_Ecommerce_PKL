<?php

namespace App\Http\Controllers\Page;

use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductPageController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        // Ambil semua kategori
        $categories = Category::all();

        // Ambil input pencarian (untuk nama produk)
        $search = $request->get('search');

        // Ambil kategori yang dipilih dari input
        $selectedCategory = $request->input('Category');
        $selectedCategories = $request->input('categories', []);

        // Ambil filter harga
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        // Ambil filter pengurutan (terlama/terbaru)
        $sortOrder = $request->input('sort_order', 'terbaru');

        // Ambil filter pengurutan harga
        $sortPrice = $request->input('sort_price'); // menambahkan filter harga

        // Ambil produk yang difilter berdasarkan kategori, harga, dan pengurutan
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('name_product', 'like', '%' . $search . '%');
            })
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->where('category_id', $selectedCategory);
            })
            ->when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
                return $query->whereIn('category_id', $selectedCategories);
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
                    return $query->orderBy('price_product', 'asc'); // Harga Rendah ke Tinggi
                } elseif ($sortPrice === 'tinggi') {
                    return $query->orderBy('price_product', 'desc'); // Harga Tinggi ke Rendah
                }
                return $query; // Default jika tidak ada filter harga
            })
            ->get();

        // Menghitung rata-rata rating untuk setiap produk
        foreach ($products as $product) {
            $product->average_rating = Review::where('product_id', $product->id)
                ->avg('rating');
        }

        // Menghitung jumlah review per produk berdasarkan product_id
        $reviewsCount = [];
        foreach ($products as $product) {
            $reviewsCount[$product->id] = Review::where('product_id', $product->id)->count();
        }

        // Return ke view dengan data produk, kategori, dan jumlah review
        return view('page.product', compact('products', 'categories', 'reviewsCount', 'search', 'minPrice', 'maxPrice', 'sortOrder', 'sortPrice'));
    }


    /**
     * Display the specified product.
     */
    /**
     * Display the specified product.
     */
    public function show(Request $request , $slug)
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

        // Tampilkan view dengan data produk, rating, jumlah review, dan produk terkait
        return view('page.productshow', compact('product', 'reviews', 'averageRating', 'reviewsCount', 'relatedProducts', 'relatedReviewsCount'));
    }

    public function addReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|in:1,2,3,4,5',
            'comment' => 'nullable|string',
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Ambil slug produk
        $product = Product::findOrFail($request->product_id);

        // Redirect kembali ke halaman produk berdasarkan slug
        return redirect()->route('page.productshow', $product->slug)
            ->with('success', 'Ulasan berhasil ditambahkan.');
    }


    /**
     * Handle the incoming request (used as a fallback).
     */
}
