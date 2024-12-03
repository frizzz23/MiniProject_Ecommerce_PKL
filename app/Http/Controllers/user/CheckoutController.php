<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // Ambil data keranjang untuk pengguna yang sedang login
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('user.checkout.index', compact('carts'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'product_id_quantity' => 'required|array',
            'diskon' => 'nullable|exists:promo_codes,code',
            'total_amount' => 'required|numeric|min:0',
            'grand_total_amount' => 'required|numeric|min:0',
        ]);

        // Cari promo code jika ada
        $diskon = PromoCode::where('code', $request->diskon)->first();

        // Buat data pesanan di tabel `orders`
        $order = Order::create([
            'user_id' => Auth::id(),
            'promo_code_id' => $diskon->id ?? null,
            'sub_total_amount' => $request->total_amount,
            'grand_total_amount' => $request->grand_total_amount,
        ]);

        // Pindahkan item dari keranjang ke tabel `product_orders`
        foreach ($request->product_id_quantity as $product_id => $quantity) {
            ProductOrder::create([
                'product_id' => $product_id,
                'order_id' => $order->id,
                'quantity' => $quantity,
            ]);
        }

        // Hapus data keranjang setelah checkout
        Cart::where('user_id', Auth::id())->delete();

        // Redirect ke halaman pesanan dengan pesan sukses
        return redirect()->route('user.orders.index')->with('success', 'Checkout berhasil! Pesanan Anda telah dibuat.');
    }
}
