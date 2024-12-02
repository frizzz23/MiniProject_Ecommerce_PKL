<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiCartController;
use App\Http\Controllers\ProfileController;


Route::get('/', HomeController::class)->name('landing-page');


Route::get('/home-page', function () {
    return view('home-page');
});

Route::middleware('auth')->group(function () {
    Route::get('/home-page', function () {
        return view('home-page');
    })->name('home-page');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/api/cart', ApiCartController::class)->only(['index', 'store', 'update', 'destroy']);

});


require __DIR__ . '/auth.php';

// Memanggil rute admin
require __DIR__ . '/admin.php';

// Memanggil rute user
require __DIR__ . '/user.php';
