<?php

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Page\AboutPageController;
use App\Http\Controllers\Page\CategoryPageController;
use App\Http\Controllers\Page\ProductPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::get('/', HomeController::class)->name('landing-page');


Route::get('/home-page', function () {
    return view('home-page');
})->name('home');

Route::get('/product-page', ProductPageController::class)->name('product-page');
Route::get('/category-page', CategoryPageController::class)->name('category-page');
Route::get('/about-page', AboutPageController::class)->name('about-page');


Route::middleware('auth')->group(function () {
    Route::get('/home-page', function () {
        return view('home-page');
    })->name('home-page');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';

// Memanggil rute admin
require __DIR__ . '/admin.php';

// Memanggil rute user
require __DIR__ . '/user.php';
