<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cart\AddController;
use App\Http\Controllers\Cart\ClearController;
use App\Http\Controllers\Cart\IndexController;
use App\Http\Controllers\Cart\RemoveController;
use App\Http\Controllers\Cart\DecrementController;
use App\Http\Controllers\Cart\IncrementController;

Route::name('cart.')->prefix('cart')->group(function () {
    Route::middleware('cartNotEmpty')->group(function () {
        Route::get('/', IndexController::class)->name('index');
        Route::post('/decrement/{product}', DecrementController::class)->name('decrement');
        Route::post('/increment/{product}', IncrementController::class)->name('increment');
        Route::post('/remove/{product}', RemoveController::class)->name('remove');
        Route::post('/clear', ClearController::class)->name('clear');
    });
    Route::post('/add/{product}', AddController::class)->name('add');
});
