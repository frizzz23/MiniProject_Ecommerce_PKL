<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
{
    // Mengambil parameter filter dari request
    $productId = $request->input('product_id'); // Filter berdasarkan ID produk
    $search = $request->input('search'); // Filter berdasarkan pencarian

    // Mengambil semua pesanan, dengan filter berdasarkan product_id dan search jika ada
    $orders = Order::with('user', 'productOrders.product', 'addresses', 'postage', 'promoCode', 'payment')
                   ->when($productId, function ($query) use ($productId) {
                       return $query->whereHas('productOrders', function ($query) use ($productId) {
                           $query->where('product_id', $productId);
                       });
                   })
                   ->when($search, function ($query, $search) {
                       return $query->whereHas('productOrders.product', function ($query) use ($search) {
                           $query->where('name_product', 'like', '%' . $search . '%');
                       });
                   })
                   ->latest()
                   ->get();

    // Mengambil semua produk yang tersedia
    $products = Product::all();

    // Mengembalikan tampilan dengan data orders dan products
    return view('admin.orders.index', compact('orders', 'products'));
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
        //
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
        // Validasi input status_order
        $validated = $request->validate([
            'status_order' => 'required|in:pending,processing,completed',
        ]);

        // Ambil pesanan berdasarkan ID
        $order = Order::findOrFail($id);

        // Update status pesanan
        $order->status_order = $request->status_order;
        $order->save();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
