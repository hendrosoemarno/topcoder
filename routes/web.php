<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/bootcamp', [FrontController::class, 'bootcampDetail'])->name('bootcamp.detail');
Route::get('/register', [FrontController::class, 'register'])->name('register');
Route::post('/register', [FrontController::class, 'storeRegister'])->name('register.store');
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::middleware(['auth:participant'])->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [\App\Http\Controllers\ParticipantDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pay/{transaction}', [\App\Http\Controllers\PaymentController::class, 'pay'])->name('pay');
});

// Callback Duitku (Exclude CSRF if needed)
Route::post('/payment/callback', [\App\Http\Controllers\PaymentController::class, 'callback'])->name('payment.callback');




// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    // Guest Admin Routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
        Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'authenticate'])->name('login.store');
    });

    // Authenticated Admin Routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Participants
        Route::resource('participants', \App\Http\Controllers\Admin\ParticipantController::class)->only(['index', 'show']);

        // Bootcamp Packages
        Route::resource('packages', \App\Http\Controllers\Admin\PackageController::class);
    });
});