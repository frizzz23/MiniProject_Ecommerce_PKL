<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class ProductOrderController extends Controller
{
    /**
     * Display a listing of the product orders.
     */
    public function index()
    {
        // Ambil semua produk dan pesanan
        $products = Product::all();
        $orders = Order::all();
        $productOrders = ProductOrder::all(); 

        // Kirim data ke view
        return view('product_orders.index', compact('products', 'orders', 'productOrders'));
    }

    /**
     * Show the form for creating a new product order.
     */
    public function create()
    {
        // Mengambil semua produk dan pesanan untuk dropdown
        $products = Product::all();
        $orders = Order::all();
        return view('product_orders.create', compact('products', 'orders'));
    }

    /**
     * Store a newly created product order in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
        ]);

        // Simpan data product order
        ProductOrder::create([
            'product_id' => $request->product_id,
            'order_id' => $request->order_id,
        ]);

        return redirect()->route('product_orders.index')->with('success', 'Produk untuk pesanan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified product order.
     */
    public function edit(ProductOrder $productOrder)
    {
        // Mengambil semua produk dan pesanan untuk dropdown
        $products = Product::all();
        $orders = Order::all();
        return view('product_orders.edit', compact('productOrder', 'products', 'orders'));
    }

    /**
     * Update the specified product order in storage.
     */
    public function update(Request $request, ProductOrder $productOrder)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
        ]);

        // Update data product order
        $productOrder->update([
            'product_id' => $request->product_id,
            'order_id' => $request->order_id,
        ]);

        return redirect()->route('product_orders.index')->with('success', 'Produk untuk pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified product order from storage.
     */
    public function destroy(ProductOrder $productOrder)
    {
        // Hapus data product order
        $productOrder->delete();

        return redirect()->route('product_orders.index')->with('success', 'Produk untuk pesanan berhasil dihapus.');
    }
}
