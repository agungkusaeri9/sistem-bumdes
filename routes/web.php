<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::redirect('/','/admin');

Auth::routes(['register' => true]);


Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/about', 'about')->name('about');
    Route::get('/cek-ongkir', 'cek_ongkir')->name('cek-ongkir');
    Route::get('/get-kota-by-provinsi', 'getKotaByProvinsiId')->name('getKotaByProvinsiId');
    Route::get('/get-kecamatan-by-provinsi', 'getKecamatanBykotaId')->name('getKecamatanByKotaId');
});

Route::controller(ProdukController::class)->group(function () {
    Route::get('/product', 'index')->name('produk.index');
    Route::get('/product/{slug}', 'show')->name('produk.show');
    Route::get('/produk/jenis/{slug}', 'jenis')->name('produk.jenis');
});

Route::middleware('auth')->controller(KeranjangController::class)->group(function () {
    Route::get('/cart', 'index')->name('keranjang.index');
    Route::post('/cart', 'store')->name('keranjang.store');
    Route::delete('/cart/{id}', 'destroy')->name('keranjang.destroy');
    Route::post('checkout', CheckoutController::class)->name('checkout');

    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/transaksi', 'index')->name('transaksi.index');
        Route::get('/transaksi/{uuid}', 'show')->name('transaksi.show');
        Route::post('/transaksi/upload-bukti/{uuid}', 'upload_bukti')->name('transaksi.upload-bukti');
    });

    Route::get('tracking/{uuid}', [TrackingController::class, 'tracking'])->name('tracking');

    Route::post('ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
});
