<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenyewaanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');
Route::resource('mobil', MobilController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('penyewaan', PenyewaanController::class);
Route::patch(
    'penyewaan/{penyewaan}/selesai',
    [PenyewaanController::class, 'selesai']
)->name('penyewaan.selesai');