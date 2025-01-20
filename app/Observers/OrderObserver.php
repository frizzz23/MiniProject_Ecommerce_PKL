<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderNotification;
use App\Models\UserOrderNotification;

class OrderObserver
{
    public function created(Order $order)
    {
        // Notifikasi untuk admin
        OrderNotification::create([
            'order_id' => $order->id,
            'is_read' => false
        ]);

        // Notifikasi untuk user
        UserOrderNotification::create([
            'user_id' => $order->user_id,
            'order_id' => $order->id,
            'message' => 'Pesanan anda #' . $order->order_code . ' sedang menunggu konfirmasi',
            'is_read' => false
        ]);
    }

    public function updated(Order $order)
    {
        if ($order->isDirty('status_order')) {
            $message = $this->getStatusMessage($order->status_order, $order->order_code);

            UserOrderNotification::create([
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'message' => $message,
                'is_read' => false
            ]);
        }
    }

    private function getStatusMessage($status, $orderCode)
    {
        return match ($status) {
            'processing' => 'Pesanan #' . $orderCode . ' sedang diproses',
            'shipping' => 'Pesanan #' . $orderCode . ' sedang dalam pengiriman',
            'completed' => 'Pesanan #' . $orderCode . ' telah selesai',
            default => 'Status pesanan #' . $orderCode . 'konfirmasi',
        };
    }
}
