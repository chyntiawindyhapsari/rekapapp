<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\RekapController;
use App\Exports\RekapExport;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::controller(ProdukController::class)->group(function() {
    Route::get('tampil-login', 'login');
    // Route::get('tampil-beranda','index')->name('produk.index');
    // Route::get('tampil-produk', 'produk')->name('produk.produk');
    // Route::post('tampil-produk', 'store')->name('produk.store');
    // // Route::get('tampil-penjualan', 'penjualan')->name('produk.penjualan');
    // // Route::get('tampil-rekap', 'rekap')->name('produk.rekap');
    // Route::get('tambah-produk', 'createproduk')->name('produk.createproduk');
    // Route::get('/produk/{id}/edit', [ProdukController::class, 'editproduk'])->name('produk.edit');
    // Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    // Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});

// Route::controller(PenjualanController::class)->group(function() {
//     Route::get('tampil-penjualan','index')->name('penjualan.penjualan');
//     Route::get('tambah-penjualan', 'createjual')->name('penjualan.createjual');
//     Route::get('/search-toko', 'searchToko')->name('search.toko');
//     Route::get('/penjualan/jumlah-pesanan', 'getJumlahPesanan');
//     Route::post('tampil-penjualan', 'store')->name('penjualan.store'); // Pastikan ini ada
//     Route::get('/penjualan/edit/{id}', [PenjualanController::class, 'editjual'])->name('penjualan.editjual');
//     Route::put('penjualan/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');
//     Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
// });

// Route::get('/rekap-penjualan', [RekapController::class, 'rekap'])->name('produk.rekap');
// Route::get('/rekap/export/excel', [RekapController::class, 'rekapExport'])->name('rekap.export');
// Route::get('/rekap/pdf-export', [RekapController::class, 'pdfExport'])->name('rekap.pdf.export');
// Route::get('/rekap/chart', [RekapController::class, 'chart'])->name('rekap.chart');
Route::get('tampil-beranda', [RekapController::class, 'index2'])->name('rekap.index');

Route::middleware(['auth','admin'])->group(function(){
    Route::get('tampil-produk', [ProdukController::class,'produk'])->name('produk.produk');
    Route::post('tampil-produk', [ProdukController::class,'store'])->name('produk.store');
    // Route::get('tampil-penjualan', 'penjualan')->name('produk.penjualan');
    // Route::get('tampil-rekap', 'rekap')->name('produk.rekap');
    Route::get('tambah-produk', [ProdukController::class,'createproduk'])->name('produk.createproduk');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'editproduk'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});

Route::middleware(['auth','admin'])->group(function(){
    Route::get('tampil-penjualan',[PenjualanController::class,'index'])->name('penjualan.penjualan');
    Route::get('tambah-penjualan', [PenjualanController::class,'createjual'])->name('penjualan.createjual');
    Route::get('/search-toko', [PenjualanController::class,'searchToko'])->name('search.toko');
    Route::get('/penjualan/jumlah-pesanan', [PenjualanController::class,'getJumlahPesanan']);
    Route::post('tampil-penjualan', [PenjualanController::class,'store'])->name('penjualan.store'); // Pastikan ini ada
    Route::get('/penjualan/edit/{id}', [PenjualanController::class, 'editjual'])->name('penjualan.editjual');
    Route::put('penjualan/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
});

Route::middleware(['auth','owner'])->group(function(){
    Route::get('/rekap-penjualan', [RekapController::class, 'rekap'])->name('produk.rekap');
    Route::get('/rekap/export/excel', [RekapController::class, 'rekapExport'])->name('rekap.export');
    Route::get('/rekap/pdf-export', [RekapController::class, 'pdfExport'])->name('rekap.pdf.export');
    Route::get('/rekap/chart', [RekapController::class, 'chart'])->name('rekap.chart');
});