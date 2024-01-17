<?php

use App\Http\Controllers\UserCardAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;

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

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/auth', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->group(function () {
Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

Route::resource('/topup', \App\Http\Controllers\Api\TopUpController::class); // tambahkan ini
// });
Route::get('home', [\App\Http\Controllers\Api\HomeController::class, 'show']);
Route::get('user-card/{id}/fingerprint', [\App\Http\Controllers\Api\UserCardController::class, 'getFingerprint']);
Route::post('is-barcode-valid', [\App\Http\Controllers\Api\UserCardController::class, 'isBarcodeValid']);
Route::post('is-validasi', [\App\Http\Controllers\Api\UserCardController::class, 'isValidasi']);
Route::get('device/{sn}', [\App\Http\Controllers\Api\DeviceController::class, 'getBySn'])->name('device.get-by-sn');
Route::post('transaction-paid', [\App\Http\Controllers\Api\TransactionController::class, 'transactionSuccess']);

Route::post('/change-password', [\App\Http\Controllers\Api\AkunController::class, 'change_password']);

Route::get('/home/{id}', [\App\Http\Controllers\Api\HomeController::class, 'show']);
Route::get('/akun/{id}', [\App\Http\Controllers\Api\AkunController::class, 'show']);
Route::get('/cari_va/{id}', [\App\Http\Controllers\Api\AkunController::class, 'cari_va']);

Route::get('/tagihan/{id}', [\App\Http\Controllers\Api\TagihanController::class, 'show']);
Route::get('/tagihan/detail/{id}', [\App\Http\Controllers\Api\TagihanController::class, 'detail']);
Route::get('/history/topup/{id}', [\App\Http\Controllers\Api\TopUpController::class, 'show']);
Route::get('/informasi/{id}', [\App\Http\Controllers\Api\InformasiController::class, 'show']);
Route::get('/informasi/detail/{id}', [\App\Http\Controllers\Api\InformasiController::class, 'detail']);
Route::get('/informasi_kesehatan/{id}', [\App\Http\Controllers\Api\InformasiKesehatanController::class, 'show']);
Route::get('/history/tagihan/{id}', [\App\Http\Controllers\Api\TagihanController::class, 'history']);
Route::get('/transaksi/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'show']);
Route::get('/transaksi/detail/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'detail']);
Route::get('/transaksi/detail_rinci/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'detail_rinci']);

Route::get('/mutasi/{id}', [\App\Http\Controllers\Api\MutasiController::class, 'show']);



// auth bank ntb
Route::get('/authentication', [\App\Http\Controllers\Api\AuthApiBankNtb::class, 'index']);

//create va
Route::get('/createva/{id}', [\App\Http\Controllers\Api\CreateVa::class, 'index']);

// Route::get('/bayar_tagihan', [\App\Http\Controllers\Api\TagihanController::class, 'bayar_tagihan']);
