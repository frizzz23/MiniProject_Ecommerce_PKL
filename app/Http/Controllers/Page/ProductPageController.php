<?php

namespace App\Http\Controllers\Page;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;

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
        $search = $request->get('search'); // Nama parameter search

        // Ambil kategori yang dipilih dari input
        $selectedCategory = $request->input('Category'); // select option
        $selectedCategories = $request->input('categories', []); // Untuk checkbox (multiple)

        // Ambil produk yang difilter berdasarkan kategori yang dipilih
        $products = Product::with('category')
            ->when($search, function ($query , $search) {
                return $query->where('name_product', 'like', '%' . $search . '%'); // Filter berdasarkan nama produk
            })
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->where('category_id', $selectedCategory); // Filter berdasarkan single category_id
            })
            ->when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
                return $query->whereIn('category_id', $selectedCategories); // Filter berdasarkan multiple category_id
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
        return view('page.product', compact('products', 'categories', 'reviewsCount','search'));
    }




    /**
     * Display the specified product.
     */
    public function show($id)
    {
        // Find the product by ID or return 404 if not found
        $product = Product::findOrFail($id);

        // Retrieve categories for the sidebar or other uses
        $categories = Category::all();

        return view('page.product_show', compact('product', 'categories'));
    }

    /**
     * Handle the incoming request (used as a fallback).
     */
}
