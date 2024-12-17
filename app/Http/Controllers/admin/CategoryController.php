<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua data kategori
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambahkan kategori baru
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
        ],[
            'name_category.required' => 'Nama kategori wajib diisi.',
            'name_category.unique' => 'Nama kategori sudah digunakan.',
            'image_category.nullable' => 'Gambar kategori wajib diisi.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_category')) {
            $imagePath = $request->file('image_category')->store('categories', 'public');
        }

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
        // Menampilkan form untuk mengedit kategori
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
        ]);

        if ($request->hasFile('image_category')) {
            if ($category->image_category && Storage::disk('public')->exists($category->image_category)) {
                Storage::disk('public')->delete($category->image_category);
            }
            $imagePath = $request->file('image_category')->store('categories', 'public');
        } else {
            $imagePath = $category->image_category;
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
        // Hapus kategori dari database
        $category->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
