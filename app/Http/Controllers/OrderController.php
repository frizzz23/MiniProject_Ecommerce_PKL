<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        // Mendapatkan semua pesanan
        $orders = Order::with('user', 'product')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // Mendapatkan semua pengguna untuk dropdown
        $products = Product::all();
        $users = User::all();
        return view('orders.create', compact('users', 'products'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'total_order' => 'required|numeric|min:0',
            'status_order' => 'required|in:pending,processing,completed',
        ]);

        // Simpan data pesanan
        Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'total_order' => $request->total_order,
            'status_order' => $request->status_order,
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        // Mendapatkan semua pengguna untuk dropdown
        $users = User::all();
        $products = Product::all();
        return view('orders.edit', compact('order', 'users', 'products'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_order' => 'required|numeric|min:0',
            'status_order' => 'required|in:pending,processing,completed',
        ]);

        // Update data pesanan
        $order->update([
            'user_id' => $request->user_id,
            'total_order' => $request->total_order,
            'status_order' => $request->status_order,
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        // Hapus pesanan
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
