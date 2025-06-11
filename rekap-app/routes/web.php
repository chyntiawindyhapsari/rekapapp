<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::controller(ProdukController::class)->group(function() {
    Route::get('tampil-login', 'login');
    Route::get('tampil-beranda','index')->name('produk.index');
    Route::get('tampil-produk', 'produk')->name('produk.produk');
    Route::post('tampil-produk', 'store')->name('produk.store');
    Route::get('tampil-penjualan', 'penjualan')->name('produk.penjualan');
    Route::get('tampil-rekap', 'rekap')->name('produk.rekap');
    Route::get('tambah-produk', 'createproduk')->name('produk.createproduk');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'editproduk'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});