<?php

use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisController;
use App\Http\Controllers\Admin\KurirController;
use App\Http\Controllers\Admin\MetodePembayaranController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SatuanController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change-password.index');
Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');

Route::resource('users', UserController::class)->except('show');
Route::resource('jenis', JenisController::class)->except('show');
Route::resource('satuan', SatuanController::class)->except('show');
Route::resource('metode-pembayaran', MetodePembayaranController::class)->except('show');
Route::resource('kurir', KurirController::class)->except('show');
