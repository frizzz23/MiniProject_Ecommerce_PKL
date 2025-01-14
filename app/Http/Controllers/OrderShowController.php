<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $order = Order::findOrFail($request->input('order_id'))
            ->load(['addresses', 'productOrders.product', 'postage', 'promoCode', 'payment', 'user']);

        // Daftar status yang tersedia
        $statuses = [
            'pending' => 1,
            'process' => 2,
            'shipping' => 3,
            'completed' => 4,
        ];

        // Tentukan status aktif berdasarkan data dari order
        $currentStatus = $statuses[$order->status] ?? 0;

        return view('user.orders.order-show', compact('order', 'statuses', 'currentStatus'));
    }
}
