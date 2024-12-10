<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\PromoCode;
use App\Models\UsedPromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $product = false;
        $carts = false;
        if ($request->product_id) {
            $product = Product::find($request->product_id);
        } else {
            $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        }
        $addresses = Address::where('user_id', Auth::id())->get();

        return view('user.checkout.index', compact('carts', 'product', 'addresses'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        // Cari promo code jika ada
        $diskon = PromoCode::findOrFail($request->id_discount);

        if ($request->order_form == 'cart') {
            // Validasi data input
            $request->validate([
                'product_id_quantity' => 'required|array',
                'id_discount' => 'nullable|exists:promo_codes,id',
                'total' => 'required|numeric|min:0',
                'subtotal' => 'required|numeric|min:0',
                'addresses_id' => 'required|exists:addresses,id',
            ]);


            // Buat data pesanan di tabel `orders`
            $order = Order::create([
                'user_id' => Auth::id(),
                'promo_code_id' => $diskon->id ?? null,
                'addresses_id' => $request->addresses_id,
                'sub_total_amount' => $request->total,
                'grand_total_amount' => $request->subtotal,
            ]);

            // Pindahkan item dari keranjang ke tabel `product_orders`
            foreach ($request->product_id_quantity as $product_id => $quantity) {
                ProductOrder::create([
                    'product_id' => $product_id,
                    'order_id' => $order->id,
                    'quantity' => $quantity,
                ]);
            }
        } else if ($request->order_form == 'product') {
        }

        // Hapus data keranjang setelah checkout
        Cart::where('user_id', Auth::id())->delete();

        $user = Auth::user();
        // Kurangi kuantitas kode promo
        $diskon->update([
            'quantity' => $diskon->quantity - 1
        ]);
        // Tandai kode promo sebagai digunakan oleh pengguna
        UsedPromoCode::create([
            'user_id' => $user->id,
            'promo_code_id' => $diskon->id,
        ]);

        $path = $request->file('bukti_image')->store('images/payments', 'public');

        Payment::create([
            'order_id' => $order->id,
            'image_payment' => $path,
            'payment_method' => 'cash',
            'status' => 'pending',
        ]);

        // Redirect ke halaman pesanan dengan pesan sukses
        return redirect()->route('user.orders.index')->with('success', 'Checkout berhasil! Pesanan Anda telah dibuat.');
    }
}
