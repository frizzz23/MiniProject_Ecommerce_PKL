<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/hallo', function (Request $request) {
    return "halo";
});

Route::post('/notification/handler', [PaymentController::class, 'create'])->name('notification.handler');
