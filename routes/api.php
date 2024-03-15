<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Login Merchant
Route::post('/login-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'login']);
Route::post('/register-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'register']);
Route::post('/logout-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'logout']);

// Produk
Route::get('/produk/{id}', [\App\Http\Controllers\Api\ProdukController::class, 'show']);
Route::get('/produk/detail/{id}', [\App\Http\Controllers\Api\ProdukController::class, 'detail']);

// Kategori
Route::get('/kategori', [\App\Http\Controllers\Api\KategoriController::class, 'show']);

// Transaksi
Route::get('/transaksi/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksi']);
Route::get('/transaksi/status/{status}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksiByStatus']);

// LoginMerchant
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// merchant
Route::post('/login-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'login']);
Route::post('/register-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'register']);
Route::post('/logout-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'logout']);
Route::get('/produk-merchant/{id}', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'show']);
Route::get('/detail-produk-merchant/{id}', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'detail']);
Route::get('/kategori-merchant', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'showKategori']);
Route::post('/create-produk-merchant', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'store']);