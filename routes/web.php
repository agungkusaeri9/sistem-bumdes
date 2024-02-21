<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PageController;
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

Auth::routes(['register' => false]);


Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/about', 'about')->name('about');
    Route::get('/cart', 'keranjang')->name('keranjang');
});

Route::controller(ProdukController::class)->group(function () {
    Route::get('/product', 'index')->name('produk.index');
    Route::get('/product/{slug}', 'show')->name('produk.show');
});
