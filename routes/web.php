<?php

use App\Http\Controllers\Auth\ForgotPassword;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\Socialites\GitHubController;

Route::get('/', IndexController::class)->name('index');

Route::middleware('guest')->group(function () {
    Route::get('/sign-up', [SignUpController::class, 'showSignUp'])->name('showSignUp');
    Route::post('/sign-up', [SignUpController::class, 'signUp'])->name('signUp');

    Route::get('/login', [LoginController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::name('password.')->group(function () {
        Route::get('/forgot-password', [ForgotPassword::class, 'showForgotPassword'])->name('forgot');
        Route::post('/forgot-password', [ForgotPassword::class, 'sendResetLink'])->name('sendResetLink');

        Route::get('/reset-password/{token}', [ResetController::class, 'showReset'])->name('reset');
        Route::post('/reset-password', [ResetController::class, 'reset'])->name('resetProccess');
    });

    Route::name('socialite.')->prefix('auth/socialite')->group(function () {
        Route::name('github')->prefix('github')->group(function () {
            Route::get('/', [GitHubController::class, 'redirectToGitHub']);
            Route::get('/callback', [GitHubController::class, 'handleGitHubCallback'])->name('.callback');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::delete('/logout', LogoutController::class)->name('logout');
});