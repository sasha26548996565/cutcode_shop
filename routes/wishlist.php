<?php

use App\Http\Controllers\Wishlist\AddController;
use Illuminate\Support\Facades\Route;

Route::name('wishlist.')->prefix('wishlist')->group(function () {
    Route::get('/add/{product}', AddController::class)->name('toggle');
});
