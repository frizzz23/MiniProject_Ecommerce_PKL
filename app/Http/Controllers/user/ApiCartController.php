<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ApiCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $ambil = 5;

    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with(['product'])->latest()->take($this->ambil)->get();
        return response()->json(['status' => 'success', 'data' =>  $cart]);
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
        $request->validate(['id_product' => 'required']);
        $product = Product::find($request->id_product);
        if (empty($product)) {
            return response()->json(['status' => 'error', 'message' => 'Product tidak ditemukan'], 404);
            die();
        }
        if ($product->stock_product <= 0) {
            return response()->json(['status' => 'error', 'message' => 'stok product sudah habis']);
            die();
        }
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();
        if ($cart) {
            if ($cart->quantity > $product->stock_product) {
                return response()->json(['status' => 'warning', 'message' => 'jumlah melebihi stok product'], 400);
                die();
            }
            $cart->update([
                'quantity' => $cart->quantity + 1,
            ]);
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }
        $cart = Cart::where('user_id', $user->id)->with(['product'])->latest()->take($this->ambil)->get();
        return response()->json(['status' => 'success', 'data' =>  $cart], 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user = Auth::user();
        $cart_delete = Cart::where('user_id', $user->id)->where('id', $id)->first();
        if (empty($cart_delete)) {
            return response()->json(['status' => 'error', 'message' => 'Product tidak ditemukan'], 404);
            die();
        }
        $cart_delete->delete();

        $cart = Cart::where('user_id', $user->id)->with(['product:id,name_product,price_product,stock_product'])->get();
        return response()->json(['status' => 'success', 'data' =>  $cart]);
    }
}
