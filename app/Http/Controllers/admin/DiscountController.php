<?php

namespace App\Http\Controllers\admin;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $codes = PromoCode::all();
        return view('admin.discount.index', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $input = $request->validate([
            'code' => 'required|unique:promo_codes,code',
            'discount_amount' => 'required|numeric',
            'quantity' => 'required|integer',
            'minimum_purchase' => 'required|numeric|min:0', // Validasi untuk minimal pembelian
        ],[
            'code.required' => 'Kode promo wajib diisi.',
            'code.unique' => 'Kode promo sudah digunakan.',
            'discount_amount.required' => 'Jumlah diskon promo wajib diisi.',
            'quantity.required' => 'Kuantitas promo wajib diisi.',
            'minimum_purchase.required' => 'Minimal pembelian promo wajib diisi.',
        ]);

        // Menambahkan promo code baru ke dalam database
        PromoCode::create($input);

        return redirect()->route('admin.discount.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail promo jika diperlukan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $promo = PromoCode::findOrFail($id);
        return view('admin.discount.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $promo = PromoCode::findOrFail($id);

        // Validasi input
        $input = $request->validate([
            'code' => 'required|unique:promo_codes,code,' . $id,
            'discount_amount' => 'required|numeric',
            'quantity' => 'required|integer',
            'minimum_purchase' => 'required|numeric|min:0', // Validasi untuk minimal pembelian
        ]);

        // Update promo code
        $promo->update($input);

        return redirect()->route('admin.discount.index')->with('success', 'Promo berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $promo = PromoCode::findOrFail($id);
            $promo->delete();
            return redirect()->route('admin.discount.index')->with('success', 'Promo berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.discount.index')->with('error', 'Promo tidak dapat dihapus.');
        }
    }
}
