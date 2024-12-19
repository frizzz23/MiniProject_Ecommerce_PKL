<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();

        $products = Product::with('category', 'brand', 'reviews')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name_product', 'like', '%' . $search . '%');
            })
            ->when($request->input('category_id'), function ($query, $category_id) {
                $query->where('category_id', $category_id);
            })
            ->when($request->input('stock_product'), function ($query, $stock_product) {
                if (in_array($stock_product, ['1', '0'], true)) {
                    $query->where('stock_product', $stock_product);
                }
            })
            ->when($request->input('price_product'), function ($query, $price_product) {
                if (in_array($price_product, ['asc', 'desc'], true)) {
                    $query->orderBy('price_product', $price_product);
                }
            })
            ->get();

        return view('admin.categories.index', compact('categories', 'brands', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_category' => 'required|string|max:255|unique:categories,name_category',
            'image_category' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name_category.required' => 'Nama kategori wajib diisi.',
            'name_category.unique' => 'Nama kategori sudah digunakan.',
            'image_category.image' => 'File harus berupa gambar.',
        ]);

        $imagePath = $request->hasFile('image_category')
            ? $request->file('image_category')->store('categories', 'public')
            : null;

        Category::create([
            'name_category' => $request->name_category,
            'image_category' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_category' => 'required|string|max:255|unique:categories,name_category,' . $category->id,
            'image_category' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name_category.required' => 'Nama kategori wajib diisi.',
            'name_category.unique' => 'Nama kategori sudah digunakan.',
            'image_category.image' => 'File harus berupa gambar.',
        ]);

        $imagePath = $category->image_category;

        if ($request->hasFile('image_category')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image_category')->store('categories', 'public');
        }

        $category->update([
            'name_category' => $request->name_category,
            'image_category' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->image_category && Storage::disk('public')->exists($category->image_category)) {
            Storage::disk('public')->delete($category->image_category);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
