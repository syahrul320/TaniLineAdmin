<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Produk
Route::get('/produk/{id}', [\App\Http\Controllers\Api\ProdukController::class, 'show']);
Route::get('/produk/detail/{id}', [\App\Http\Controllers\Api\ProdukController::class, 'detail']);

// Kategori
Route::get('/kategori', [\App\Http\Controllers\Api\KategoriController::class, 'show']);

// Transaksi
Route::get('/transaksi/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksi']);
Route::get('/transaksi/status/{status}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksiByStatus']);