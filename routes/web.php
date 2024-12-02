<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ApiCartController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CodeDiscountController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Page\AboutPageController;
use App\Http\Controllers\Page\CategoryPageController;
use App\Http\Controllers\Page\ProductPageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('landing-page');



Route::get('/home-page', function () {
    return view('home-page');
})->name('home');

Route::get('/product-page', ProductPageController::class)->name('product-page');
Route::get('/category-page', CategoryPageController::class)->name('category-page');
Route::get('/about-page', AboutPageController::class)->name('about-page');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin page
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('code-discount', CodeDiscountController::class);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// user page
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('addresses', AddressController::class);
    Route::resource('carts', CartController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('product_orders', ProductOrderController::class);
    Route::resource('reviews', ReviewController::class);

    // Route::resource('cart1', CartUserController::class);

    Route::post('/api/validate-promo', DiscountController::class);
    Route::resource('/api/cart', ApiCartController::class)->only(['index', 'store', 'update', 'destroy']);
});

require __DIR__ . '/auth.php';
