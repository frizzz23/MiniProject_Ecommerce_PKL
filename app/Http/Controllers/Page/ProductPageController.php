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
        $categories = Category::get(); // Get the categories
        $products = Product::get(); // Get all products

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

        return view('page.product', compact('products', 'categories', 'reviewsCount'));
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
