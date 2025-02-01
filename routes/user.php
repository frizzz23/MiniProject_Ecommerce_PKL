<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AkunController;


use App\Http\Controllers\ReviewController;


use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\user\ApiCartController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\user\DiscountController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\user\CartController as UserCartController;
use App\Http\Controllers\user\OrderController as UserOrderController;
use App\Http\Controllers\user\AddressController as UserAddressController;


Route::middleware(['auth', 'role:user'])->group(function () {
    // Route notifikasi
    Route::get('/notifications/{id}/mark-as-read', [UserNotificationController::class, 'markAsRead'])
        ->name('notifications.mark-as-read');

    // Menandai semua notifikasi sebagai sudah baca
    Route::get('/notifications/mark-all-as-read', [UserNotificationController::class, 'markAllAsRead'])
        ->name('notifications.mark-all-as-read');

    Route::resource('checkout', CheckoutController::class)->only(['index', 'store'])->names([
        'index' => 'user.checkout.index',
        'store' => 'user.checkout.store',
    ]);
    Route::resource('orders', UserOrderController::class)->names([
        'index' => 'user.orders.index',
        'show' => 'user.orders.show',
        'store' => 'user.orders.store',
        'update' => 'user.orders.update',
        'destroy' => 'user.orders.destroy',
    ]);
    Route::get('/orders/{order}/download-invoice', [UserOrderController::class, 'downloadInvoice'])->name('user.orders.download-invoice');
    Route::post('/addRiview', [UserOrderController::class, 'addRiview'])->name('user.orders.addRiview');
    Route::post('user/order/update-status/{id}', [UserOrderController::class, 'updateStatus'])->name('user.order.updateStatus');
    Route::resource('addresses', UserAddressController::class)->names([
        'index' => 'user.addresses.index',
        'store' => 'user.addresses.store',
        'update' => 'user.addresses.update',
        'destroy' => 'user.addresses.destroy',
    ]);
    Route::resource('carts', UserCartController::class)->names([
        'index' => 'user.carts.index',
        'store' => 'user.carts.store',
        'update' => 'user.carts.update',
        'destroy' => 'user.carts.destroy',
    ]);

    // profile route
    Route::get('user/akun/profile', [ProfileController::class, 'profile'])->name('user.profile.profile');
    Route::get('user/akun/password', [ProfileController::class, 'password'])->name('user.profile.password');
    Route::get('user/akun/delete', [ProfileController::class, 'delete'])->name('user.profile.delete');

    Route::patch('user/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('user/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');

    // Route::resource('payments', PaymentController::class);
    Route::post('/create-snap-token', [PaymentController::class, 'CreateSnapToken'])->name('craete.snap.token');
    Route::resource('product_orders', ProductOrderController::class);
    Route::resource('reviews', ReviewController::class);
    Route::post('/api/validate-promo', [DiscountController::class, 'validatePromo']);
    Route::resource('/api/cart', ApiCartController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::post('api/raja-ongkir/cost', [RajaOngkirController::class, 'cost']);
    Route::get('api/raja-ongkir/province', [RajaOngkirController::class, 'province']);
    Route::get('api/raja-ongkir/city', [RajaOngkirController::class, 'city']);
});
