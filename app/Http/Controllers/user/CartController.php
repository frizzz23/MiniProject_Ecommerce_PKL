<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua produk yang ada di dalam keranjang milik pengguna yang sedang login
        $carts = Cart::with('product')
            ->where('user_id', Auth::id()) // Filter berdasarkan user yang sedang login
            ->get();

        $products = Product::all();

        return view('user.carts.index', compact('carts','products'));
    }

    /**
     * Show the form for adding a new product to the cart.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Cek apakah produk sudah ada di keranjang user
        $cart = Cart::where('product_id', $request->product_id)
            ->where('user_id', Auth::id()) // Filter untuk user yang sedang login
            ->first();

        if ($cart) {
            // Jika produk sudah ada, update jumlahnya
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity,
            ]);
        } else {
            // Jika produk belum ada, tambahkan produk ke keranjang
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('user.carts.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Show the form for editing the quantity of a product in the cart.
     */
    public function edit(Cart $cart)
    {
        // Pastikan keranjang milik user yang sedang login
        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit keranjang ini.');
        }

        return view('user.carts.edit', compact('cart'));
    }

    /**
     * Update the specified product quantity in the cart.
     */
    public function update(Request $request, Cart $cart)
    {
        // Pastikan keranjang milik user yang sedang login
        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk memperbarui keranjang ini.');
        }

        // Validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update jumlah produk di dalam keranjang
        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('user.carts.index')->with('success', 'Jumlah produk di keranjang berhasil diperbarui.');
    }

    /**
     * Remove the specified product from the cart.
     */
    public function destroy(Cart $cart)
    {
        // Pastikan keranjang milik user yang sedang login
        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus keranjang ini.');
        }

        // Hapus produk dari keranjang
        $cart->delete();

        return redirect()->route('user.carts.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
