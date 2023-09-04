<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ShowController;

Route::name('product.')->prefix('product')->group(function () {
    Route::get('/{product:slug}', ShowController::class)->name('show'); 
});
