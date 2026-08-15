<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenyewaanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    if (Auth::user()->role === 'admin') {
        return redirect()->route('dashboard');
    }
    return redirect()->route('landing');

})->name('home');


Route::get('/landing', [LandingController::class, 'index'])->name('landing');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('admin')->name('dashboard');

Route::resource('mobil', MobilController::class);
Route::resource('pelanggan', PelangganController::class);   
Route::resource('penyewaan', PenyewaanController::class);
Route::patch('penyewaan/{penyewaan}/selesai',[PenyewaanController::class, 'selesai'])->name('penyewaan.selesai');


Route::get('/register', [AuthController::class, 'showRegister'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');