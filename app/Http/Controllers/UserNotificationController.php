<?php

namespace App\Http\Controllers;

use App\Models\UserOrderNotification;

class UserNotificationController extends Controller
{
    // Metode untuk menandai satu notifikasi sebagai sudah baca
    public function markAsRead($id)
    {
        $notification = UserOrderNotification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return redirect()->route('user.orders.show', $notification->order_id);
    }

    // Metode untuk menandai semua notifikasi sebagai sudah baca
    public function markAllAsRead()
    {
        UserOrderNotification::where('user_id', auth()->id())
            ->where('is_read', false) 
            ->update(['is_read' => true]);

        return redirect()->back();
    }
}
