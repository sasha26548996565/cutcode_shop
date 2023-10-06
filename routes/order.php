<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Order\ShowController;
use App\Http\Controllers\Order\IndexController;
use App\Http\Controllers\Order\StoreController;
use App\Http\Controllers\Order\DestroyController;

Route::name('order.')->prefix('order')->group(function () {
    Route::get('/', IndexController::class)->name('index');
    Route::get('/{order}', ShowController::class)->name('show');
    Route::post('/store', StoreController::class)->name('store');
    Route::delete('/{order}', DestroyController::class)->name('destroy');
});
