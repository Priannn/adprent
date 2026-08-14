<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\LandingController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenyewaanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('admin')->name('dashboard');

Route::resource('mobil', MobilController::class);
Route::resource('pelanggan', PelangganController::class);   
Route::resource('penyewaan', PenyewaanController::class);
Route::patch('penyewaan/{penyewaan}/selesai',[PenyewaanController::class, 'selesai'])->name('penyewaan.selesai');


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');