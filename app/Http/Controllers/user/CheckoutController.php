<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('user.checkout.index', compact('carts'));
    }

    public function store(Request $request)
    {
        //         array:5 [▼ // app\Http\Controllers\user\CheckoutController.php:20
        //   "_token" => "agSGgC2z29I4DcoTdqACPm7moYwWpINKKkKfcTSI"
        //   "product_id_quantity" => array:2 [▼
        //     1 => "4"
        //     2 => "2"
        //   ]
        //   "diskon" => "MURAH"
        //   "total_amount" => "13600000"
        //   "grand_total_amount" => "20780000"
        // ]
        $request->validate([
            'product_id_quantity' => 'required|array',
            'diskon' => 'nullable|exists:promo_codes,code',
            'total_amount' => 'required|numeric|min:0',
            'grand_total_amount' => 'required|numeric|min:0',
        ]);
        $diskon = PromoCode::where('code', $request->diskon)->first();

        // Simpan data pesanan
        $order =  Order::create([
            'user_id' => Auth::id(),
            'promo_code_id' => $diskon->id ?? null,
            'sub_total_amount' => $request->total_amount,
            'grand_total_amount' => $request->grand_total_amount,
        ]);

        foreach ($request->product_id_quantity as $product_id => $quantity) {
            $product = Product::findOrFail($product_id);
            ProductOrder::create([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'quantity' => $quantity,
            ]);
        }


        return redirect()->route('user.orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }
}
