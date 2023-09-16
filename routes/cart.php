<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
