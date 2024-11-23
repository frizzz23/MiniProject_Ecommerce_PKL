<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua produk dengan kategori terkait
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mendapatkan semua kategori untuk dropdown
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name_product' => 'required|string|max:255',
            'description_product' => 'required|string',
            'image_product' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image_product')) {
            $imagePath = $request->file('image_product')->store('products', 'public');
        }

        // Simpan data produk
        Product::create([
            'name_product' => $request->name_product,
            'description_product' => $request->description_product,
            'image_product' => $imagePath,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Mendapatkan semua kategori untuk dropdown
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validasi input
        $request->validate([
            'name_product' => 'required|string|max:255',
            'description_product' => 'required|string',
            'image_product' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Upload gambar baru jika ada
        $imagePath = $product->image_product;
        if ($request->hasFile('image_product')) {
            $imagePath = $request->file('image_product')->store('products', 'public');
        }

        // Update data produk
        $product->update([
            'name_product' => $request->name_product,
            'description_product' => $request->description_product,
            'image_product' => $imagePath,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Hapus produk
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
