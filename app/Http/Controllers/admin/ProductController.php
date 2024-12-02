<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua produk beserta kategori
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('admin.products.index', compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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

        // Proses penyimpanan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image_product')) {
            $imagePath = $request->file('image_product')->store('products', 'public');
        }

        // Simpan data produk
        Product::create([
            'name_product' => $request->name_product,
            'description_product' => $request->description_product,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'category_id' => $request->category_id,
            'image_product' => $imagePath,  // Simpan gambar jika ada
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Mendapatkan semua kategori untuk dropdown
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
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

        // Proses penyimpanan gambar baru jika ada
        if ($request->hasFile('image_product')) {
            // Hapus gambar lama jika ada
            if ($product->image_product && Storage::disk('public')->exists($product->image_product)) {
                Storage::disk('public')->delete($product->image_product);
            }
            $imagePath = $request->file('image_product')->store('products', 'public');
        } else {
            $imagePath = $product->image_product; // Jika gambar tidak diupload, gunakan gambar lama
        }

        // Update data produk
        $product->update([
            'name_product' => $request->name_product,
            'description_product' => $request->description_product,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'category_id' => $request->category_id,
            'image_product' => $imagePath,  // Simpan gambar yang baru (atau gambar lama jika tidak ada perubahan)
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Hapus gambar produk dari storage
        if ($product->image_product && Storage::disk('public')->exists($product->image_product)) {
            Storage::disk('public')->delete($product->image_product);
        }

        // Hapus produk
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
