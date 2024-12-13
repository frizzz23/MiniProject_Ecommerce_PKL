<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua data brand
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambahkan brand baru
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_brand' => 'required|string|max:255|unique:brands,name_brand',
            'image_brand' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_brand')) {
            $imagePath = $request->file('image_brand')->store('brands', 'public');
        }

        Brand::create([
            'name_brand' => $request->name_brand,
            'image_brand' => $imagePath,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
         // Menampilkan form untuk mengedit brand
         return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        // Validasi input
        $request->validate([
            'name_brand' => 'required|string|max:255|unique:brands,name_brand,' . $brand->id,
            'image_brand' => 'nullable|image|mimes:jpeg,png,jpg|max:2048,' . $brand->id,
        ]);

         // Proses penyimpanan gambar baru jika ada
         if ($request->hasFile('image_brand')) {
            // Hapus gambar lama jika ada
            if ($brand->image_brand && Storage::disk('public')->exists($brand->image_brand)) {
                Storage::disk('public')->delete($brand->image_brand);
            }
            $imagePath = $request->file('image_brand')->store('brand', 'public');
        } else {
            $imagePath = $brand->image_product; // Jika gambar tidak diupload, gunakan gambar lama
        }

        // Update data di database
        $brand->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('admin.brands.index')->with('success', 'Brand berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        // Hapus kategori dari database
        $brand->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.brands.index')->with('success', 'Brand berhasil dihapus.');
    }
}
