<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderNotification;

class OrderObserver
{
    public function created(Order $order)
    {
        OrderNotification::create([
            'order_id' => $order->id,
            'is_read' => false
        ]);
    }
}