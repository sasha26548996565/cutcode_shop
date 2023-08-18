<?php

use App\Http\Controllers\Catalog\IndexController;
use Illuminate\Support\Facades\Route;

Route::name('catalog.')->prefix('catalog')->group(function () {
    Route::get('/{category:slug?}', IndexController::class)->name('index');
});
