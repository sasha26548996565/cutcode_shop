<?php

use App\Http\Controllers\Wishlist\AddController;
use App\Http\Controllers\Wishlist\IndexController;
use Illuminate\Support\Facades\Route;

Route::name('wishlist.')->prefix('wishlist')->group(function () {
    Route::middleware('wishlistNotEmpty')->group(function () {
        Route::get('/', IndexController::class)->name('index');
    });

    Route::get('/add/{product}', AddController::class)->name('toggle');
});
