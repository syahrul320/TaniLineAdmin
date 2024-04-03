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
// Route::post('/register', [\App\Http\Controllers\Api\LoginUserController::class, 'register']);
Route::post('/logout', [\App\Http\Controllers\Api\LoginUserController::class, 'logout']);
// Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/produk/{id}', [\App\Http\Controllers\Api\ProdukController::class, 'show']);
    // Route::get('/produk/detail/{id}', [\App\Http\Controllers\Api\ProdukController::class, 'detail']);
    // Route::get('/kategori', [\App\Http\Controllers\Api\KategoriController::class, 'show']);
    // Route::get('/transaksi/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksi']);
    // Route::get('/transaksi/status/{status}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksiByStatus']);
// });

Route::get('/produk-terlaris', [\App\Http\Controllers\Api\ProdukController::class, 'produk_terlaris']);
Route::get('/kategori', [\App\Http\Controllers\Api\KategoriController::class, 'show']);
Route::get('/informasi-terbaru', [\App\Http\Controllers\Api\InformasiController::class, 'show']);
Route::get('/keranjang-belanja', [\App\Http\Controllers\Api\KeranjangBelanjaController::class, 'show']);
Route::post('/registrasi', [\App\Http\Controllers\Api\RegistrasiController::class, 'register']);
Route::post('/ubah-nama', [\App\Http\Controllers\Api\RegistrasiController::class, 'update_nama']);
Route::get('/get-nama-pengguna/{id}', [\App\Http\Controllers\Api\RegistrasiController::class, 'get_nama_pengguna']);
Route::post('/ubah-email', [\App\Http\Controllers\Api\RegistrasiController::class, 'update_email']);
Route::get('/get-email-pengguna/{id}', [\App\Http\Controllers\Api\RegistrasiController::class, 'get_email_pengguna']);
Route::post('/ubah-password', [\App\Http\Controllers\Api\RegistrasiController::class, 'update_password']);
Route::get('/get-alamat-pengguna/{id}', [\App\Http\Controllers\Api\RegistrasiController::class, 'get_alamat_pengguna']);
Route::post('/ubah-alamat', [\App\Http\Controllers\Api\RegistrasiController::class, 'update_alamat']);
Route::delete('/delete-keranjang-belanja', [\App\Http\Controllers\Api\KeranjangBelanjaController::class, 'delete']);



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

// Flip
Route::post('/payment/{id}', [\App\Http\Controllers\Api\TopupController::class, 'store']);
Route::post('/payment/notification', [\App\Http\Controllers\Api\TopupController::class, 'notification']);