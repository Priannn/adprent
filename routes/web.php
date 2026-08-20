<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenyewaanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;


Route::get('/', [LandingController::class, 'index'])->name('landing'); 


Route::middleware('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('mobil', MobilController::class);

    Route::resource('pelanggan', PelangganController::class);

    Route::resource('penyewaan', PenyewaanController::class);

    Route::patch(
        'penyewaan/{penyewaan}/selesai',
        [PenyewaanController::class, 'selesai']
    )->name('penyewaan.selesai');
    
    Route::patch(
    'penyewaan/{penyewaan}/konfirmasi',
    [PenyewaanController::class, 'konfirmasi']
    )->name('penyewaan.konfirmasi');

    Route::patch(
        'penyewaan/{penyewaan}/batalkan',
        [PenyewaanController::class, 'batalkan']
    )->name('penyewaan.batalkan');

});

Route::get('/register', [AuthController::class, 'showRegister'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/booking/{mobil}', [BookingController::class, 'create'])
    ->middleware('auth')
    ->name('booking.create');

Route::post('/booking', [BookingController::class, 'store'])
    ->middleware('auth')
    ->name('booking.store');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::get('/riwayat-pemesanan', [ProfileController::class, 'history'])
        ->name('booking.history');

});

Route::get('/booking/availability', [PenyewaanController::class, 'availability'])
    ->name('booking.availability');