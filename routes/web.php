<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ThumbnailController;

Route::get('/', IndexController::class)->name('index');

Route::get('/storage/images/{directory}/{method}/{size}/{file}', ThumbnailController::class)
    ->where('method', 'resize|crop|fit')
    ->where('size', '\d+x\d+')
    ->name('thumbnail');
