<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data kategori untuk dropdown
        $categories = Category::all();
        $brands = Brand::all();

        // Ambil kata kunci pencarian dan kategori yang dipilih dari request
        $search = $request->input('search');
        $category_id = $request->input('category_id');
        $stock_product = $request->input('stock_product');
        $price_product = $request->input('price_product');
        $brand_id = $request->input('brand_id');

        // Query produk dengan filter berdasarkan kategori dan pencarian
        $products = Product::with('category', 'stock', 'brand')
            ->when($search, function ($query) use ($search) {
                return $query->where('name_product', 'like', '%' . $search . '%');
            })
            ->when($category_id, function ($query) use ($category_id) {
                return $query->where('category_id', $category_id);
            })
            ->when($stock_product, function ($query) use ($stock_product) {
                return $query->where('stock_product', $stock_product);
            })
            ->when($price_product, function ($query) use ($price_product) {
                return $query->where('price_product', $price_product);
            })
            ->when($brand_id, function ($query) use ($brand_id) {
                return $query->where('brand_id', $brand_id);
            })
            ->paginate(5); 

        // Return data ke view dengan data pencarian dan kategori
        return view('admin.products.index', compact('products', 'categories', 'search', 'category_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

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
            'brand_id' => 'required|exists:brands,id',
        ]);

        // Proses penyimpanan gambar product
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
            'brand_id' => $request->brand_id,
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

    public function show(Product $product)
    {
        $product = Product::with('category')->findOrFail($product->id);
        $categories = Category::all();
        return view('admin.products.show', compact('product', 'categories'));
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
            'brand_product' => 'required|string',
            'image_product' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
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
            'brand_product' => $request->brand_product,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
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
