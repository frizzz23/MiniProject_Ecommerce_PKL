<?php

namespace App\Http\Controllers\Admin;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input =  $request->validate([
            'code' => 'required|unique:promo_codes,code',
            'discount_amount' => 'required'
        ]);

        PromoCode::create($input);
        return redirect()->route('admin.discount.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $promo = PromoCode::findOrFail($id);
        $input =  $request->validate([
            'code' => 'required|unique:promo_codes,code,' . $id,
            'discount_amount' => 'required'
        ]);

        $promo->update($input);
        return redirect()->route('admin.discount.index')->with('success', 'Promo berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $promo = PromoCode::findorFail($id);
            $promo->delete();
            return redirect()->route('admin.discount.index')->with('success', 'Promo berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.discount.index')->with('error', 'Promo tidak dapat dihapus.');
        }
    }
}
