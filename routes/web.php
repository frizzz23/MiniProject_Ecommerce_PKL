<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;


use App\Http\Controllers\Page\ContactController;
use App\Http\Controllers\Page\FAQPageController;
use App\Http\Controllers\Page\HomePageController;
use App\Http\Controllers\Page\AboutPageController;
use App\Http\Controllers\Page\ContactPageController;
use App\Http\Controllers\Page\ProductPageController;
use App\Http\Controllers\Page\CategoryPageController;


Route::get('/', [HomePageController::class, 'index'])->name('landing-page');


// Route::get('/home-page', function () {
//     return view('home-page');
// })->name('home');


// Route::get('/account', function () {
//     return view('account');
// })->name('account');



Route::get('/product', [ProductPageController::class, 'index'])->name('page.product');
Route::get('/product-show/{slug}', [ProductPageController::class, 'show'])->name('page.productshow');
Route::post('/addReview', [ProductPageController::class, 'addReview'])->name('addReview');




Route::get('/category-page', CategoryPageController::class)->name('category-page');
Route::get('/about', AboutPageController::class)->name('about-page');
Route::get('/contact', ContactPageController::class)->name('contact-page');
Route::get('/FAQ', [FAQPageController::class, 'index'])->name('faq-page');




Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});


require __DIR__ . '/auth.php';

// Memanggil rute admin
require __DIR__ . '/admin.php';

// Memanggil rute user
require __DIR__ . '/user.php';
