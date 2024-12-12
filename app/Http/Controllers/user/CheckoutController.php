<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Models\UsedPromoCode;
use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $product = false;
        $carts = false;
        if ($request->input('product')) {
            $slug = $request->input('product');
            $product = Product::where('slug', $slug)->first();
            if (!$product) {
                return redirect()->route('landing-page');
            }
        } else {
            $carts = Cart::where('user_id', Auth::id())->with('product')->get();
            if (count($carts) <= 0) {
                return redirect()->route('landing-page');
            }
        }
        $addresses = Address::where('user_id', Auth::id())->get();
        $provinces = Province::relatedData();

        return view('user.checkout.index', compact('carts', 'product', 'addresses', 'provinces'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'bukti_image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $diskon = PromoCode::find($request->id_discount);

        $request->validate([
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
            'sub_total_amount' => $request->subtotal,
            'grand_total_amount' => $request->total,
        ]);

        if ($request->order_form == 'cart') {
            $request->validate([
                'product_id_quantity' => 'required|array',
            ]);

            // Pindahkan item dari keranjang ke tabel `product_orders`
            foreach ($request->product_id_quantity as $product_id => $quantity) {
                ProductOrder::create([
                    'product_id' => $product_id,
                    'order_id' => $order->id,
                    'quantity' => $quantity,
                ]);
                $stok =   Product::where('id', $product_id)->first();
                $stok->decrement('stock_product', $quantity);
            }
            // Hapus data keranjang setelah checkout
            Cart::where('user_id', Auth::id())->delete();
        } else if ($request->order_form == 'product') {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity_checkout' => 'required|numeric|min:1',
            ]);
            $p =  ProductOrder::create([
                'product_id' => $request->product_id,
                'order_id' => $order->id,
                'quantity' => $request->quantity_checkout,
            ]);
            $stok = Product::where('id', $request->product_id)->first();
            $stok->decrement('stock_product', $request->quantity_checkout);
        } else {
            return redirect()->route('landing-page');
        }


        $user = Auth::user();
        if ($diskon) {
            // Kurangi kuantitas kode promo
            $diskon->update([
                'quantity' => $diskon->quantity - 1
            ]);
            // Tandai kode promo sebagai digunakan oleh pengguna
            UsedPromoCode::create([
                'user_id' => $user->id,
                'promo_code_id' => $diskon->id,
            ]);
        }

        $path = $request->file('bukti_image')->store('images/payments', 'public');

        Payment::create([
            'order_id' => $order->id,
            'image_payment' => $path,
            'payment_method' => 'transfer',
            'status' => 'pending',
        ]);

        // Redirect ke halaman pesanan dengan pesan sukses
        return redirect()->route('user.orders.index')->with('success', 'Checkout berhasil! Pesanan Anda telah dibuat.');
    }
}
