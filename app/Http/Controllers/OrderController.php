<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
{
    $orders = Order::with('user', 'product', 'promoCode')->get();
    $users = User::all(); // Get all users
    $products = Product::all(); // Get all products

    return view('orders.index', compact('orders', 'users', 'products'));
}

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        $promoCodes = PromoCode::all();
        return view('orders.create', compact('users', 'products', 'promoCodes'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id.*' => 'exists:products,id', // Validate each product ID
            'sub_total_amount' => 'required|numeric|min:0',
            'grand_total_amount' => 'required|numeric|min:0',
            'status_order' => 'required|in:pending,processing,completed',
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'promo_code_id' => $request->promo_code_id,
            'sub_total_amount' => $request->sub_total_amount,
            'grand_total_amount' => $request->grand_total_amount,
            'status_order' => $request->status_order,
        ]);



        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $users = User::all();
        $products = Product::all();
        $promoCodes = PromoCode::all();
        return view('orders.edit', compact('order', 'users', 'products', 'promoCodes'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Validate input
        $request->validate([
            'user_id' => 'required|exists:users,id',

            'product_ids.*' => 'exists:products,id', // Validate each product ID
            'sub_total_amount' => 'required|numeric|min:0',
            'grand_total_amount' => 'required|numeric|min:0',
            'status_order' => 'required|in:pending,processing,completed',
        ]);

        // Update the order
        $order->update([
            'user_id' => $request->user_id,
            'promo_code_id' => $request->promo_code_id,
            'sub_total_amount' => $request->sub_total_amount,
            'grand_total_amount' => $request->grand_total_amount,
            'status_order' => $request->status_order,
        ]);

        // Sync products (Many-to-Many relationship)
        $order->products()->sync($request->product_ids);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->products()->detach(); // Detach products before deleting order
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
