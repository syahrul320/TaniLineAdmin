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

// });
Route::get('/transaksi/status/{status}/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksiByStatus']);
Route::get('/produk-terlaris/{lat}/{long}', [\App\Http\Controllers\Api\ProdukController::class, 'produk_terlaris']);
Route::get('/list-produk/{lat}/{long}', [\App\Http\Controllers\Api\ProdukController::class, 'list_produk']);
Route::get('/list-produk-by-kategori/{id}/{lat}/{long}', [\App\Http\Controllers\Api\ProdukController::class, 'list_produk_by_kategori']);
Route::get('/kategori', [\App\Http\Controllers\Api\KategoriController::class, 'show']);
Route::get('/informasi-terbaru', [\App\Http\Controllers\Api\InformasiController::class, 'show']);

//KERANJANG BELANJA
Route::get('/keranjang-belanja/{id_user}', [\App\Http\Controllers\Api\KeranjangBelanjaController::class, 'show']);
Route::post('/tambah-keranjang-belanja', [\App\Http\Controllers\Api\KeranjangBelanjaController::class, 'store']);
Route::post('/keranjang-belanja-delete', [\App\Http\Controllers\Api\KeranjangBelanjaController::class, 'destroy']);
Route::get('/pesan/{id}', [\App\Http\Controllers\Api\PesananController::class, 'pesan']);


Route::get('/pencarian/{keyword}/{lat}/{long}', [\App\Http\Controllers\Api\ProdukController::class, 'pencarian']);
Route::get('/pencarian-by-kategori/{id_kategori}/{lat}/{long}', [\App\Http\Controllers\Api\ProdukController::class, 'pencarian_by_kategori']);
Route::get('/detail-produk/{id}/{lat}/{long}', [\App\Http\Controllers\Api\ProdukController::class, 'detail']);
Route::post('/store-transaksi-by-produk', [\App\Http\Controllers\Api\TransaksiController::class, 'store_by_produk']);


Route::get('/transaksi/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksi']);
Route::get('/transaksi/status/{status}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksiByStatus']);

Route::get('/store-transaksi/', [\App\Http\Controllers\Api\TransaksiController::class, 'store']);

Route::post('/distance-cost/', [\App\Http\Controllers\Api\TransaksiController::class, 'getDistanceCost']);
Route::post('/cancel-transaksi/', [\App\Http\Controllers\Api\TransaksiController::class, 'cancelTransaksi']);
Route::get('/detail-transaksi/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'showDetailTransaksi']);


Route::post('/registrasi', [\App\Http\Controllers\Api\RegistrasiController::class, 'register']);
Route::post('/ubah-nama', [\App\Http\Controllers\Api\RegistrasiController::class, 'update_nama']);
Route::get('/get-nama-pengguna/{id}', [\App\Http\Controllers\Api\RegistrasiController::class, 'get_nama_pengguna']);
Route::post('/ubah-email', [\App\Http\Controllers\Api\RegistrasiController::class, 'update_email']);
Route::get('/get-email-pengguna/{id}', [\App\Http\Controllers\Api\RegistrasiController::class, 'get_email_pengguna']);
Route::post('/ubah-password/{id}', [\App\Http\Controllers\Api\RegistrasiController::class, 'update_password']);
Route::get('/get-alamat-pengguna/{id}', [\App\Http\Controllers\Api\RegistrasiController::class, 'get_alamat_pengguna']);
Route::post('/ubah-alamat', [\App\Http\Controllers\Api\RegistrasiController::class, 'update_alamat']);


Route::get('/pesanan/{id}', [\App\Http\Controllers\Api\PesananController::class, 'show']);


// // merchant
// Route::post('/login-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'login']);
// Route::post('/register-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'register']);
// Route::post('/logout-merchant', [\App\Http\Controllers\Api\LoginMerchantController::class, 'logout']);
// // Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/produk-merchant/{id}', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'show']);
//     Route::get('/detail-produk-merchant/{id}', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'detail']);
//     Route::get('/kategori-merchant', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'showKategori']);
//     Route::post('/create-produk-merchant', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'store']);
//     Route::delete('/destroy-produk-merchant/{id}', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'destroy']);
//     Route::put('/update-produk-merchant/{id}', [\App\Http\Controllers\Api\ProdukMerchantController::class, 'update']);
//     Route::get('/show-transaksi-merchant/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'showDetailTransaksiMerchant']);
//     // Flip
//     Route::post('/topup', [\App\Http\Controllers\Api\TopupController::class, 'store']);
//     Route::post('/topup/notification', [\App\Http\Controllers\Api\TopupController::class, 'notification']);
//     //lokasi
//     Route::put('/lokasi-merchant/{id}', [\App\Http\Controllers\Api\LokasiMerchantController::class, 'update']);
// // });



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
    Route::get('/show-transaksi-merchant/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'showDetailTransaksiMerchant']);
    // Flip
    Route::post('/topup', [\App\Http\Controllers\Api\TopupController::class, 'store']);
    Route::post('/topup/notification', [\App\Http\Controllers\Api\TopupController::class, 'notification']);
    //lokasi
    Route::put('/lokasi-merchant/{id}', [\App\Http\Controllers\Api\LokasiMerchantController::class, 'update']);
    //setting
    Route::get('/setting-merchant/{id}', [\App\Http\Controllers\Api\SettingController::class, 'showSetting']);
    Route::put('/setting-merchant/{id}', [\App\Http\Controllers\Api\SettingController::class, 'updateSetting']);
    Route::put('/setting-merchant/update-password/{id}', [\App\Http\Controllers\Api\SettingController::class, 'update_password']);

    //transaksi
    Route::get('/transaksi_merchant/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'showTransaksiMerchant']);
    Route::get('/detail-transaksi-merchant/{kode}', [\App\Http\Controllers\Api\TransaksiController::class, 'detailTransaksiMerchant']);
    Route::get('/pesanan-diterima-merchant/{kode}', [\App\Http\Controllers\Api\TransaksiController::class, 'showPesananDiterima']);
    Route::get('/pesanan-selesai-merchant/{kode}', [\App\Http\Controllers\Api\TransaksiController::class, 'showPesananSelesai']);
    Route::get('/pesanan-dibatalkan-merchant/{kode}', [\App\Http\Controllers\Api\TransaksiController::class, 'showPesananDibatalkan']);
    Route::get('/pesanan-diproses-merchant/{kode}', [\App\Http\Controllers\Api\TransaksiController::class, 'showPesananDiproses']);
    Route::put('/update-status-transaksi/{kode}', [\App\Http\Controllers\Api\TransaksiController::class, 'updateStatusTransaksi']);
    Route::get('/billing/{kode}', [\App\Http\Controllers\Api\TransaksiController::class, 'showBillingselesai']);

// });
