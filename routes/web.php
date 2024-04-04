<?php

use App\Http\Controllers\BlankPage;
use App\Http\Controllers\CashOutMerchantController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanMerchantController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MutasiMerchantController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SaldoMerchantController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserController;
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


Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth')->middleware('guest');

// admin
Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard')->middleware(['cekrole:admin']);
Route::get('/blank-page', [BlankPage::class, 'index'])->name('blank-page')->middleware(['cekrole:admin']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware(['cekrole:admin']);
Route::get('/dashboard/transaksi/', [Dashboard::class, 'transaksi'])->name('transaksi')->middleware(['cekrole:admin']);
Route::get('/dashboard/topup/', [Dashboard::class, 'topup'])->name('topup')->middleware(['cekrole:admin']);

// Kategori 
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori')->middleware(['cekrole:admin']);
Route::post('/kategori-insert-data', [KategoriController::class, 'insert_data'])->name('kategori.insert.data')->middleware(['cekrole:admin']);
Route::post('/kategori-edit-data', [KategoriController::class, 'edit'])->name('kategori.edit.data')->middleware(['cekrole:admin']);
Route::post('/kategori-update-data', [KategoriController::class, 'update'])->name('kategori.update.data')->middleware(['cekrole:admin']);
Route::post('/kategori-delete-data', [KategoriController::class, 'destroy'])->name('kategori.delete.data')->middleware(['cekrole:admin']);

// Data User
Route::get('/user', [UserController::class, 'index'])->name('user')->middleware(['cekrole:admin']);
Route::post('/user-insert-data', [UserController::class, 'insert_data'])->name('user.insert.data')->middleware(['cekrole:admin']);
Route::post('/user-edit-data', [UserController::class, 'edit'])->name('user.edit.data')->middleware(['cekrole:admin']);
Route::post('/user-update-data', [UserController::class, 'update'])->name('user.update.data')->middleware(['cekrole:admin']);
Route::post('/user-delete-data', [UserController::class, 'destroy'])->name('user.delete.data')->middleware(['cekrole:admin']);

// Data User
Route::get('/maps', [MapController::class, 'index'])->name('maps')->middleware(['cekrole:admin']);

// Data Merchant
Route::get('/data-merchant', [MerchantController::class, 'index'])->name('data-merchant')->middleware(['cekrole:admin']);
Route::post('/data-merchant-insert-data', [MerchantController::class, 'insert_data'])->name('data-merchant.insert.data')->middleware(['cekrole:admin']);
Route::post('/data-merchant-edit-data', [MerchantController::class, 'edit'])->name('data-merchant.edit.data')->middleware(['cekrole:admin']);
Route::post('/data-merchant-update-data', [MerchantController::class, 'update'])->name('data-merchant.update.data')->middleware(['cekrole:admin']);
Route::post('/data-merchant-delete-data', [MerchantController::class, 'destroy'])->name('data-merchant.delete.data')->middleware(['cekrole:admin']);

// Data User Admin
Route::get('/useradmin', [UserAdminController::class, 'index'])->name('useradmin')->middleware(['cekrole:admin']);
Route::post('/useradmin-insert-data', [UserAdminController::class, 'insert_data'])->name('useradmin.insert.data')->middleware(['cekrole:admin']);
Route::post('/useradmin-edit-data', [UserAdminController::class, 'edit'])->name('useradmin.edit.data')->middleware(['cekrole:admin']);
Route::post('/useradmin-update-data', [UserAdminController::class, 'update'])->name('useradmin.update.data')->middleware(['cekrole:admin']);
Route::post('/useradmin-delete-data', [UserAdminController::class, 'destroy'])->name('useradmin.delete.data')->middleware(['cekrole:admin']);

// Setting
Route::get('/setting', [SettingController::class, 'index'])->name('setting')->middleware(['cekrole:admin']);
Route::post('/setting-update-data', [SettingController::class, 'update'])->name('setting.update.data')->middleware(['cekrole:admin']);

// Data Informasi
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi')->middleware(['cekrole:admin']);
Route::post('/informasi-insert-data', [InformasiController::class, 'insert_data'])->name('informasi.insert.data')->middleware(['cekrole:admin']);
Route::post('/informasi-edit-data', [InformasiController::class, 'edit'])->name('informasi.edit.data')->middleware(['cekrole:admin']);
Route::post('/informasi-update-data', [InformasiController::class, 'update'])->name('informasi.update.data')->middleware(['cekrole:admin']);
Route::post('/informasi-delete-data', [InformasiController::class, 'destroy'])->name('informasi.delete.data')->middleware(['cekrole:admin']);

// Data Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk')->middleware(['cekrole:admin']);
Route::post('/produk-kategori-select', [ProdukController::class, 'getKategori'])->name('produk.kategori.select')->middleware(['cekrole:admin']);
Route::post('/produk-merchant-select', [ProdukController::class, 'getMerchant'])->name('produk.merchant.select')->middleware(['cekrole:admin']);
Route::post('/produk-delete-data', [ProdukController::class, 'destroy'])->name('produk.delete.data')->middleware(['cekrole:admin']);

// Saldo Merchant
Route::get('/saldo-merchant', [SaldoMerchantController::class, 'index'])->name('saldo-merchant')->middleware(['cekrole:admin']);

// Transaski Merchant
Route::get('/transaksi-pembeli', [TransaksiController::class, 'index'])->name('transaksi-pembeli')->middleware(['cekrole:admin']);
Route::post('/transaksi-card-select', [TransaksiController::class, 'getUser'])->name('transaksi.usercard.select')->middleware(['cekrole:admin']);
Route::post('/transaksi-produk-select', [TransaksiController::class, 'getProduk'])->name('transaksi.produk.select')->middleware(['cekrole:admin']);
Route::get('/transaksi-pembeli/transaksi_detail/{id}', [TransaksiController::class, 'transaksi_detail'])->name('transaksi-detail')->middleware(['cekrole:admin']);

// Laporan Merchant
Route::get('/laporan-merchant', [LaporanMerchantController::class, 'index'])->name('laporan-merchant')->middleware(['cekrole:admin']);
Route::post('/merchant-select', [LaporanMerchantController::class, 'getMerchant'])->name('merchant.select')->middleware(['cekrole:admin']);
Route::get('/laporan-merchant/export', [LaporanMerchantController::class, 'export'])->name('laporan-merchant.export')->middleware(['cekrole:admin']);

// Cashout Merchant
Route::get('/cashout-merchant', [CashOutMerchantController::class, 'index'])->name('cashout-merchant')->middleware(['cekrole:admin']);
Route::post('/cashout-merchant-insert-data', [CashOutMerchantController::class, 'insert_data'])->name('cashout-merchant.insert.data')->middleware(['cekrole:admin']);
Route::post('/cashout-merchant-delete-data', [CashOutMerchantController::class, 'destroy'])->name('cashout-merchant.delete.data')->middleware(['cekrole:admin']);
Route::get('/cashout-merchant-saldo/{id}', [CashOutMerchantController::class, 'saldo'])->name('cashout-merchant.saldo')->middleware(['cekrole:admin']);
Route::get('cashout-merchant-cetak/{id}', [CashOutMerchantController::class, 'print'])->name('cashout-merchant.print')->middleware(['cekrole:admin']);

// Mutasi Merchant
Route::get('/mutasi-merchant', [MutasiMerchantController::class, 'index'])->name('mutasi-merchant')->middleware(['cekrole:admin']);
Route::get('/mutasi-merchant/export', [MutasiMerchantController::class, 'export'])->name('mutasi-merchant.export')->middleware(['cekrole:admin']);

// Topup
Route::get('/topup', [TopupController::class, 'index'])->name('topup')->middleware(['cekrole:admin']);