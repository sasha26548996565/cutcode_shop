<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Checkout\IndexController;

Route::name('checkout.')->prefix('checkout')->group(function () {
    Route::get('/', IndexController::class)->name('index');
});
