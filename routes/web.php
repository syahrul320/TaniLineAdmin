<?php

use App\Http\Controllers\AnjunganMandiriController;
use App\Http\Controllers\AutoDebetBayarController;
use App\Http\Controllers\BankAdminController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlankPage;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DataTopUpController;
use App\Http\Controllers\DataTransaksiUserController;
use App\Http\Controllers\Det_tagihanAdminController;
use App\Http\Controllers\Det_tagihanController;
use App\Http\Controllers\DeviceAdminController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HistorySehatAdminController;
use App\Http\Controllers\HistorySehatController;
use App\Http\Controllers\HistorySehatMerchantController;
use App\Http\Controllers\ImportUserController;
use App\Http\Controllers\InformasiAdminController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\JenisTagihanAdminController;
use App\Http\Controllers\JenisTagihanController;
use App\Http\Controllers\KasKeluarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriUserAdminController;
use App\Http\Controllers\KategoriUserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LapUserController;
use App\Http\Controllers\LembagaAdminController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Master_tagihanAdminController;
use App\Http\Controllers\Master_tagihanController;
use App\Http\Controllers\MerchantAdminController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MerchantMerchantController;
use App\Http\Controllers\MutasiMerchantAdminController;
use App\Http\Controllers\MutasiMerchantController;
use App\Http\Controllers\MutasiMerchantMerchantController;
use App\Http\Controllers\MutasiRekeningAdminController;
use App\Http\Controllers\MutasiRekeningController;
use App\Http\Controllers\MutasiRekeningMerchantController;
use App\Http\Controllers\MutasiRekeningPerUserController;
use App\Http\Controllers\PencairanController;
use App\Http\Controllers\PencairanMerchantController;
use App\Http\Controllers\PerusahaanAdminController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\RekeningMerchantAdminController;
use App\Http\Controllers\RekeningPolingController;
use App\Http\Controllers\SaldoMerchantAdminController;
use App\Http\Controllers\SaldoMerchantController;
use App\Http\Controllers\SaldoMerchantMerchantController;
use App\Http\Controllers\SaldoUserCardAdminController;
use App\Http\Controllers\SaldoUserCardController;
use App\Http\Controllers\SaldoUserCardMerchantController;
use App\Http\Controllers\Tagihan_userAdminController;
use App\Http\Controllers\Tagihan_userController;
use App\Http\Controllers\TestBayarController;
use App\Http\Controllers\TransaksiMerchantAdminController;
use App\Http\Controllers\TransaksiMerchantController;
use App\Http\Controllers\TransaksiMerchantMerchantController;
use App\Http\Controllers\TransaksiPembayaranAdminController;
use App\Http\Controllers\TransaksiPembayaranController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserCardAdminController;
use App\Http\Controllers\UserCardController;
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

// Kategori 
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori')->middleware(['cekrole:admin']);
Route::post('/kategori-insert-data', [KategoriController::class, 'insert_data'])->name('kategori.insert.data')->middleware(['cekrole:admin']);
Route::post('/kategori-edit-data', [KategoriController::class, 'edit'])->name('kategori.edit.data')->middleware(['cekrole:admin']);
Route::post('/kategori-update-data', [KategoriController::class, 'update'])->name('kategori.update.data')->middleware(['cekrole:admin']);
Route::post('/kategori-delete-data', [KategoriController::class, 'destroy'])->name('kategori.delete.data')->middleware(['cekrole:admin']);

// Data User Profile admin
Route::get('/user', [UserController::class, 'index'])->name('user')->middleware(['cekrole:admin']);
Route::post('/user-insert-data', [UserController::class, 'insert_data'])->name('user.insert.data')->middleware(['cekrole:admin']);
Route::post('/user-edit-data', [UserController::class, 'edit'])->name('user.edit.data')->middleware(['cekrole:admin']);
Route::post('/user-update-data', [UserController::class, 'update'])->name('user.update.data')->middleware(['cekrole:admin']);
Route::post('/user-delete-data', [UserController::class, 'destroy'])->name('user.delete.data')->middleware(['cekrole:admin']);
