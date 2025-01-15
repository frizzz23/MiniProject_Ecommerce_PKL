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


        return view('user.orders.order-show', compact('order'));
    }
}
