<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderNotification;
use App\Observers\OrderObserver; // Tambahkan import ini
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        Carbon::setLocale('id');

        Order::observe(OrderObserver::class); // Sekarang sudah benar karena class sudah diimport

        View::composer('*', function ($view) {
            $user = Auth::user();

            if ($user instanceof User && $user->hasRole('admin')) {
                $unreadNotifications = OrderNotification::with(['order.user', 'order.productOrders.product'])
                    ->where('is_read', false)
                    ->latest()
                    ->get();
                $view->with('unreadNotifications', $unreadNotifications);
            } else {
                $view->with('unreadNotifications', collect([]));
            }
        });
    }
}
