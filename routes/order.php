<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Order\IndexController;
use App\Http\Controllers\Order\StoreController;

Route::name('order.')->prefix('order')->group(function () {
    Route::get('/', IndexController::class)->name('index');
    Route::post('/store', StoreController::class)->name('store');
});
