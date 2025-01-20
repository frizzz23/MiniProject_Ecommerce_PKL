<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderNotification;
use App\Models\UserOrderNotification;
use App\Observers\OrderObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        Carbon::setLocale('id');

        Order::observe(OrderObserver::class);

        View::composer('*', function ($view) {
            $user = Auth::user();

            if ($user) {
                if ($user->hasRole('admin')) {
                    $unreadNotifications = OrderNotification::with(['order.user', 'order.productOrders.product'])
                        ->where('is_read', false)
                        ->latest()
                        ->get();
                    $view->with('unreadNotifications', $unreadNotifications);
                } else {
                    $userNotifications = UserOrderNotification::with(['order'])
                        ->where('user_id', $user->id)
                        ->where('is_read', false)
                        ->latest()
                        ->get();
                    $view->with('userNotifications', $userNotifications);
                }
            }
        });
    }
}