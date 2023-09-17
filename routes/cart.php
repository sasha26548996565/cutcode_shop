<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cart\AddController;
use App\Http\Controllers\Cart\IndexController;

Route::name('cart.')->prefix('cart')->group(function () {
    Route::middleware('cartNotEmpty')->group(function () {
        Route::get('/', IndexController::class)->name('index');
    });
    Route::post('/add/{product}', AddController::class)->name('add');
});
