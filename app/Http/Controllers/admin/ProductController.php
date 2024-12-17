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
        $categories = Category::all(); // Mendapatkan semua kategori
        $brands = Brand::all(); // Mendapatkan semua merek

        $products = Product::with('category', 'brand')
            ->when($request->input('search'), function ($query, $search) {
                // Filter berdasarkan nama produk
                $query->where('name_product', 'like', '%' . $search . '%');
            })
            ->when($request->input('category_id'), function ($query, $category_id) {
                // Filter berdasarkan kategori
                $query->where('category_id', $category_id);
            })
            ->when($request->input('stock_product'), function ($query, $stock_product) {
                // Pastikan stok dalam bentuk string, karena form mengirimkan string ('1' atau '0')
                if ($stock_product === '1' || $stock_product === '0') {
                    $query->where('stock_product', $stock_product);
                }
            })
            ->when($request->input('price_product'), function ($query, $price_product) {
                // Filter berdasarkan harga (terendah ke tertinggi atau sebaliknya)
                if ($price_product == 'asc') {
                    $query->orderBy('price_product', 'asc');
                } elseif ($price_product == 'desc') {
                    $query->orderBy('price_product', 'desc');
                }
            })
            ->when($request->input('brand_id'), function ($query, $brand_id) {
                // Filter berdasarkan merek
                $query->where('brand_id', $brand_id);
            })
            ->paginate(5); // Menampilkan 5 produk per halaman

        // Mengirim data ke view
        return view('admin.products.index', compact('products', 'categories', 'brands'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'description_product' => 'required|string',
            'image_product' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ],[
            'name_product.required' => 'Nama produk wajib diisi.',
            'description_product.required' => 'Deskripsi produk wajib diisi.',
            'image_product.nullable' => 'Gambar produk wajib diisi.',
            'stock_product.required' => 'Stok produk wajib diisi.',
            'price_product.required' => 'Harga produk wajib diisi.',
            'category_id.required' => 'Kategori produk wajib diisi.',
            'brand_id.required' => 'Merek produk wajib diisi.',
        ]);

        $imagePath = $request->file('image_product')
            ? $request->file('image_product')->store('products', 'public')
            : null;

        Product::create($request->except('image_product') + ['image_product' => $imagePath]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
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
            'brand_id' => 'required|exists:brands,id',
        ]);

        // Jika ada file gambar baru yang diunggah
        if ($request->hasFile('image_product')) {
            // Hapus gambar lama jika ada
            if ($product->image_product && Storage::disk('public')->exists($product->image_product)) {
                Storage::disk('public')->delete($product->image_product);
            }

            // Simpan gambar baru dan perbarui path-nya
            $imagePath = $request->file('image_product')->store('products', 'public');
            $product->image_product = $imagePath;
        }

        // Perbarui data produk lainnya
        $product->update($request->except('image_product'));

        // Simpan gambar baru jika ada
        if (isset($imagePath)) {
            $product->image_product = $imagePath;
            $product->save();
        }

        // Redirect kembali ke halaman produk
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image_product) {
            Storage::disk('public')->delete($product->image_product);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
