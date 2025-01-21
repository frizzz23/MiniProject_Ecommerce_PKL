<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderNotification;

class AdminNotificationController extends Controller
{
    public function markAsRead($orderId)
    {
        OrderNotification::where('order_id', $orderId)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        // Menandai semua notifikasi yang belum dibaca pada order terkait
        OrderNotification::where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back();
    }
}
