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

// User
Route::post('/login', [\App\Http\Controllers\Api\LoginUserController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\LoginUserController::class, 'register']);
Route::post('/logout', [\App\Http\Controllers\Api\LoginUserController::class, 'logout']);
// Route::middleware('auth:sanctum')->group(function () {
    Route::get('/produk/{id}', [\App\Http\Controllers\Api\ProdukController::class, 'show']);
    Route::get('/produk/detail/{id}', [\App\Http\Controllers\Api\ProdukController::class, 'detail']);
    Route::get('/kategori', [\App\Http\Controllers\Api\KategoriController::class, 'show']);
    Route::get('/transaksi/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksi']);
    Route::get('/transaksi/status/{status}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksiByStatus']);
// });


// merchant
Route::post('/login-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'login']);
Route::post('/register-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'register']);
Route::post('/logout-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'logout']);
// Route::middleware('auth:sanctum')->group(function () {
    Route::get('/produk-merchant/{id}', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'show']);
    Route::get('/detail-produk-merchant/{id}', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'detail']);
    Route::get('/kategori-merchant', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'showKategori']);
    Route::post('/create-produk-merchant', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'store']);
    Route::delete('/destroy-produk-merchant/{id}', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'destroy']);
    Route::put('/update-produk-merchant/{id}', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'update']);
// });
