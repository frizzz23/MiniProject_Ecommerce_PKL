<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua data kategori
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambahkan kategori baru
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name_category' => 'required|string|max:255|unique:categories,name_category',
        ]);

        // Simpan data ke database
        Category::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Menampilkan form untuk mengedit kategori
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validasi input
        $request->validate([
            'name_category' => 'required|string|max:255|unique:categories,name_category,' . $category->id,
        ]);

        // Update data di database
        $category->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Hapus kategori dari database
        $category->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
