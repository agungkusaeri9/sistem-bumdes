<?php

use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriProdukController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\JenisController;
use App\Http\Controllers\Admin\KurirController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MetodePembayaranController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SatuanController;
use App\Http\Controllers\Admin\StokProdukController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use App\Models\GaleriProduk;
use App\Models\StokProduk;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change-password.index');
Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');

// role admin
Route::middleware('cek_role:admin')->group(function () {
    Route::resource('users', UserController::class)->except('show');
    Route::resource('jenis', JenisController::class)->except('show');
    Route::resource('jabatan', JabatanController::class)->except('show');
    Route::resource('pengurus', PengurusController::class)->except('show');
    Route::resource('satuan', SatuanController::class)->except('show');
    Route::resource('metode-pembayaran', MetodePembayaranController::class)->except('show');
    Route::resource('kurir', KurirController::class)->except('show');
    Route::resource('produk', ProdukController::class)->except('show');
    Route::controller(GaleriProdukController::class)->name('galeri-produk.')->group(function () {
        Route::get('/galeri-produk/{id}', 'index')->name('index');
        Route::post('/galeri-produk/{id}', 'store')->name('store');
        Route::delete('/galeri-produk/{id}', 'destroy')->name('destroy');
    });

    Route::controller(StokProdukController::class)->name('stok-produk.')->group(function () {
        Route::get('/stok-produk', 'index')->name('index');
        Route::post('/stok-produk', 'store')->name('store');
        Route::delete('/stok-produk/{id}', 'destroy')->name('destroy');
    });

    Route::resource('transaksi', TransaksiController::class);
});

Route::controller(LaporanController::class)->name('laporan.')->group(function () {
    Route::get('/laporan/transaksi', 'transaksi_index')->name('transaksi.index')->middleware('cek_role:admin');
    Route::post('/laporan/transaksi', 'transaksi_print')->name('transaksi.print')->middleware('cek_role:admin');
    Route::get('/laporan/keuangan', 'keuangan_index')->name('keuangan.index');
    Route::post('/laporan/keuangan', 'keuangan_print')->name('keuangan.print');
});
