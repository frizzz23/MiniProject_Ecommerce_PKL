<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Page\AboutPageController;
use App\Http\Controllers\Page\ProductPageController;
use App\Http\Controllers\Page\CategoryPageController;




Route::get('/', HomeController::class)->name('landing-page');
Route::get('/landing-page2', HomeController::class)->name('landing-page2');

Route::get('/home-page', function () {
    return view('home-page');
})->name('home');


Route::get('/account', function () {
    return view('account');
})->name('home');



Route::get('/product-page', [ProductPageController::class, 'index'])->name('page.product');
Route::get('/product-page/{id}', [ProductPageController::class, 'show'])->name('page.productshow');



Route::get('/category-page', CategoryPageController::class)->name('category-page');
Route::get('/about-page', AboutPageController::class)->name('about-page');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';

// Memanggil rute admin
require __DIR__ . '/admin.php';

// Memanggil rute user
require __DIR__ . '/user.php';
