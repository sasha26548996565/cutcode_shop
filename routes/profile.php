<?php

use App\Http\Controllers\Profile\EditController;
use App\Http\Controllers\Profile\UpdateController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('profile.')->prefix('profile')->group(function () {
    Route::get('/', EditController::class)->name('edit');
    Route::post('/update/{user}', UpdateController::class)->name('update');
});
