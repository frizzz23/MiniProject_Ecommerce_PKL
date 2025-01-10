<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\OrderNotification;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil parameter filter dari request
        $priceProduct = $request->input('price'); // Filter berdasarkan harga produk
        $statusOrder = $request->input('status_order'); // Filter berdasarkan status order
        $createdAt = $request->input('created_at'); // Filter berdasarkan tanggal
        $search = $request->input('search'); // Filter berdasarkan pencarian

        // Ambil notifikasi yang belum dibaca
        $unreadNotifications = OrderNotification::with(['order.user', 'order.productOrders.product'])
            ->where('is_read', false)
            ->latest()
            ->get();

        // Mengambil semua pesanan, dengan filter berdasarkan price, status_order, created_at, dan search jika ada
        $orders = Order::with('user', 'productOrders.product', 'addresses', 'postage', 'promoCode', 'payment')
            ->when($priceProduct, function ($query) use ($priceProduct) {
                return $query->orderBy('grand_total_amount', $priceProduct); // Filter harga berdasarkan grand_total_amount
            })
            ->when($statusOrder, function ($query) use ($statusOrder) {
                return $query->where('status_order', $statusOrder);
            })
            ->when($createdAt, function ($query) use ($createdAt) {
                return $query->orderBy('created_at', $createdAt);
            })
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('productOrders.product', function ($query) use ($search) {
                    $query->where('name_product', 'like', '%' . $search . '%');
                });
            })
            ->latest() // Mengurutkan berdasarkan yang terbaru
            ->paginate(10);  // Added pagination to limit results per page

        // Mengambil semua produk yang tersedia untuk digunakan dalam form filter jika diperlukan
        $products = Product::all();

        // Mengembalikan tampilan dengan data orders dan products
        return view('admin.orders.index', compact('orders', 'products', 'unreadNotifications'));
    }

    public function markAsRead($orderId)
    {
        OrderNotification::where('order_id', $orderId)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
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
