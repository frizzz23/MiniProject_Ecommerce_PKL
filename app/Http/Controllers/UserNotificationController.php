<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserOrderNotification;

class UserNotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = UserOrderNotification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return redirect()->route('user.orders.show', $notification->order_id);
    }

    
}
