<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua produk dengan kategori terkait
        $products = Product::with('category', 'images')->get();
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
            'image_product' => 'nullable|array', // Pastikan image_product adalah array
            'image_product.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi setiap elemen di array
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Simpan data produk
        $product =  Product::create([
            'name_product' => $request->name_product,
            'description_product' => $request->description_product,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image_product')) {
            foreach ($request->image_product as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'image_product' => $path,
                    'product_id' => $product->id,
                ]);
            }
        }

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
        // dd($request->all());
        // Validasi input
        $request->validate([
            'name_product' => 'required|string|max:255',
            'description_product' => 'required|string',
            'image_product' => 'nullable|array', // Pastikan image_product adalah array
            'image_product.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi setiap elemen di array
            'image_edit_product' => 'nullable|array', // Pastikan image_edit_product adalah array
            'image_edit_product.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi setiap elemen di array
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Update data produk
        $product->update([
            'name_product' => $request->name_product,
            'description_product' => $request->description_product,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'category_id' => $request->category_id,
        ]);


        // ambil semua image yang ada
        $images = ProductImage::where('product_id', $product->id)->get();

        // ambil id imagenya
        $image_id = $images->pluck('id')->toArray();

        // ambil id image yang di submit
        $request_image_id = $request->image_id ?? [];

        // ambil id image yang tidak sama dengan id yang di submit
        $delete_image_id = array_diff($image_id, $request_image_id);

        // hapus image yang tidak sama dengan id di db dan di submit
        if (isset($delete_image_id)) {
            foreach ($delete_image_id as $id) {
                $image = ProductImage::findOrFail($id);
                if (Storage::disk('public')->exists($image->image_product)) {
                    Storage::disk('public')->delete($image->image_product);
                }
                ProductImage::findOrFail($id)->delete();
            }
        }

        // simpan image yang di submit
        if ($request->hasFile('image_product')) {
            foreach ($request->image_product as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'image_product' => $path,
                    'product_id' => $product->id,
                ]);
            }
        }

        if ($request->hasFile('image_edit_product')) {
            foreach ($request->image_edit_product as $index => $image) {
                $image_find = ProductImage::findOrFail($index);
                if (Storage::disk('public')->exists($image_find->image_product)) {
                    Storage::disk('public')->delete($image_find->image_product);
                }
                $path = $image->store('products', 'public');
                $image_find->update([
                    'image_product' => $path,
                    'product_id' => $product->id,
                ]);
            }
        }

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
