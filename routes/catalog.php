<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Catalog\IndexController;

Route::name('catalog.')->prefix('catalog')->group(function () {
    Route::get('/{category:slug?}', IndexController::class)->name('index');
});
