<?php

namespace App\Http\Controllers\user;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    // Endpoint untuk mendapatkan diskon berdasarkan kode promo
    public function __invoke(Request $request)
    {
        $code = $request->input('code'); // Ambil kode dari parameter request

        // Cari promo berdasarkan kode
        $promo = PromoCode::where('code', $code)->first();

        if ($promo) {
            return response()->json([
                'status' => 'success',
                'discount' => $promo->discount_amount, // Kembalikan jumlah diskon
            ]);
            die();
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Kode promo tidak valid',
        ], 400); // Jika tidak ada kode promo yang cocok
    }
}
