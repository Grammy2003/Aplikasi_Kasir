<?php

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
Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\SupplierController;
Route::resource('suppliers', SupplierController::class);

use App\Http\Controllers\CategoryController;
Route::resource('categories', CategoryController::class);

use App\Http\Controllers\SatuanController;
Route::resource('satuans', SatuanController::class);

use App\Http\Controllers\PelangganController;
Route::resource('pelanggans', PelangganController::class);

use App\Http\Controllers\ProductController;
Route::resource('products', ProductController::class);

use App\Http\Controllers\TransaksiPenjualanController;
Route::resource('transaksi_penjualans', TransaksiPenjualanController::class);

use App\Http\Controllers\DetailPenjualanController;
Route::resource('detail_penjualans', DetailPenjualanController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/transaksi_penjualans/struk/{id}', [TransaksiPenjualanController::class, 'struk'])->name('transaksi_penjualans.struk');

use App\Http\Controllers\LaporanController;

Route::get('/laporan-penjualan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan-penjualan/cetak', [LaporanController::class, 'laporanPenjualan'])->name('laporan.penjualan');
