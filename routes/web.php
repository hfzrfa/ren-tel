<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;

Route::get('/', [CarController::class, 'index'])->name('landing');

// Admin panel will be provided via Filament (to be installed); native CRUD removed.

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Booking routes (require login)
Route::middleware('auth')->group(function () {
	Route::get('/book', [BookingController::class, 'create'])->name('booking.create');
	Route::post('/book', [BookingController::class, 'store'])->name('booking.store');
	Route::get('/book/success', [BookingController::class, 'success'])->name('booking.success');
});
