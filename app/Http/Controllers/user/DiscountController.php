<?php

namespace App\Http\Controllers\user;

use App\Models\PromoCode;
use App\Models\UsedPromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    public function validatePromo(Request $request)
    {
        $user = $request->user(); // Dapatkan pengguna saat ini (pastikan middleware auth digunakan)
        $code = $request->input('code'); // Ambil kode dari parameter request
        $total = $request->input('total'); // Ambil kode dari parameter request

        if (!$total) {
            return response()->json([
                'status' => 'error',
                'message' => 'Total harus diisi',
            ], 400);
        }

        // Cari promo berdasarkan kode
        $promo = PromoCode::where('code', $code)->first();

        if (!$promo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode promo tidak valid',
            ], 400);
        }

        // Periksa apakah kode promo memiliki kuantitas yang cukup
        if ($promo->quantity <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode promo sudah habis',
            ], 400);
        }

        // Periksa apakah pengguna sudah menggunakan kode promo ini
        $alreadyUsed = UsedPromoCode::where('user_id', $user->id)
            ->where('promo_code_id', $promo->id)
            ->exists();

        if ($alreadyUsed) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode promo sudah digunakan',
            ], 400);
        }

        if ($total < $promo->minimum_purchase) {
            return response()->json([
                'status' => 'error',
                'message' => 'Total Minimal ' . number_format($promo->minimum_purchase, 0, ',', '.'),
            ], 400);
        }

        return response()->json([
            'id' => $promo->id,
            'status' => 'success',
            'discount' => $promo->discount_amount,
        ]);
    }
}
