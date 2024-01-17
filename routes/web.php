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

// perusahaan
Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard')->middleware(['cekrole:1,2,3,4,5,7,8,10']);
Route::get('/dashboard/nominal_transaksi/', [Dashboard::class, 'nominal_transaksi'])->name('nominal_transaksi')->middleware(['cekrole:1,2,3,4,5,7,8,10']);
Route::get('/dashboard/jumlah_transaksi', [Dashboard::class, 'jumlah_transaksi'])->name('jumlah_transaksi')->middleware(['cekrole:1,2,3,4,5,7,8,10']);






Route::get('/blank-page', [BlankPage::class, 'index'])->name('blank-page')->middleware(['cekrole:1,2,3,4,5,8,10']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware(['cekrole:1,2,3,4,5,7,8,10']);

// Perusahaan Admin
Route::get('/perusahaan_admin', [PerusahaanAdminController::class, 'index'])->name('perusahaan_admin')->middleware(['cekrole:2,4']);

// Perusahaan
Route::get('/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan')->middleware(['cekrole:1']);
Route::post('/perusahaan-insert-data', [PerusahaanController::class, 'insert_data'])->name('perusahaan.insert.data')->middleware(['cekrole:1']);
Route::post('/perusahaan-edit-data', [PerusahaanController::class, 'edit'])->name('perusahaan.edit.data')->middleware(['cekrole:1']);
Route::post('/perusahaan-update-data', [PerusahaanController::class, 'update'])->name('perusahaan.update.data')->middleware(['cekrole:1']);
Route::post('/perusahaan-delete-data', [PerusahaanController::class, 'destroy'])->name('perusahaan.delete.data')->middleware(['cekrole:1']);
Route::post('/perusahaan-detail-data', [PerusahaanController::class, 'detail'])->name('perusahaan.detail.data')->middleware(['cekrole:1']);

// Rekening Poling perusahaan
Route::get('/rekeningpoling', [RekeningPolingController::class, 'index'])->name('rekeningpoling')->middleware(['cekrole:1']);
Route::get('/rekeningpoling/{id}', [RekeningPolingController::class, 'index'])->name('rekeningpoling')->middleware(['cekrole:1']);
Route::post('/rekeningpoling-insert-data', [RekeningPolingController::class, 'insert_data'])->name('rekeningpoling.insert.data')->middleware(['cekrole:1']);
Route::post('/rekeningpoling-edit-data', [RekeningPolingController::class, 'edit'])->name('rekeningpoling.edit.data')->middleware(['cekrole:1']);
Route::post('/rekeningpoling-update-data', [RekeningPolingController::class, 'update'])->name('rekeningpoling.update.data')->middleware(['cekrole:1']);
Route::post('/rekeningpoling-delete-data', [RekeningPolingController::class, 'destroy'])->name('rekeningpoling.delete.data')->middleware(['cekrole:1']);
Route::post('/rekeningpoling-detail-data', [RekeningPolingController::class, 'detail'])->name('rekeningpoling.detail.data')->middleware(['cekrole:1']);

// Rekening Merchant admin
// Route::get('/rekeningmerchantadmin', [RekeningMerchantAdminController::class, 'index'])->name('rekeningmerchantadmin')->middleware(['cekrole:2']);
Route::get('/rekeningmerchantadmin/{id}', [RekeningMerchantAdminController::class, 'index'])->name('rekeningmerchantadmin')->middleware(['cekrole:2']);
Route::post('/rekeningmerchantadmin-insert-data', [RekeningMerchantAdminController::class, 'insert_data'])->name('rekeningmerchantadmin.insert.data')->middleware(['cekrole:2']);
Route::post('/rekeningmerchantadmin-edit-data', [RekeningMerchantAdminController::class, 'edit'])->name('rekeningmerchantadmin.edit.data')->middleware(['cekrole:2']);
Route::post('/rekeningmerchantadmin-update-data', [RekeningMerchantAdminController::class, 'update'])->name('rekeningmerchantadmin.update.data')->middleware(['cekrole:2']);
Route::post('/rekeningmerchantadmin-delete-data', [RekeningMerchantAdminController::class, 'destroy'])->name('rekeningmerchantadmin.delete.data')->middleware(['cekrole:2']);
Route::post('/rekeningmerchantadmin-detail-data', [RekeningMerchantAdminController::class, 'detail'])->name('rekeningmerchantadmin.detail.data')->middleware(['cekrole:2']);

// Kategori User Perusahaan
Route::get('/kategoriuser', [KategoriUserController::class, 'index'])->name('kategoriuser')->middleware(['cekrole:1']);
Route::get('/kategoriuser/{id}', [KategoriUserController::class, 'kategori'])->name('kategoriuser.kategori')->middleware(['cekrole:1']);
Route::post('/kategoriuser-insert-data', [KategoriUserController::class, 'insert_data'])->name('kategoriuser.insert.data')->middleware(['cekrole:1']);
Route::post('/kategoriuser-edit-data', [KategoriUserController::class, 'edit'])->name('kategoriuser.edit.data')->middleware(['cekrole:1']);
Route::post('/kategoriuser-update-data', [KategoriUserController::class, 'update'])->name('kategoriuser.update.data')->middleware(['cekrole:1']);
Route::post('/kategoriuser-delete-data', [KategoriUserController::class, 'destroy'])->name('kategoriuser.delete.data')->middleware(['cekrole:1']);
Route::post('/kategoriuser-detail-data', [KategoriUserController::class, 'detail'])->name('kategoriuser.detail.data')->middleware(['cekrole:1']);

// Kategori User Admin
Route::get('/kategoriuseradmin', [KategoriUserAdminController::class, 'index'])->name('kategoriuseradmin')->middleware(['cekrole:2,4,5']);
// Route::get('/kategoriuseradmin/{id}', [KategoriUserAdminController::class, 'kategori'])->name('kategoriuseradmin.kategori')->middleware(['cekrole:2']);
Route::post('/kategoriuseradmin-insert-data', [KategoriUserAdminController::class, 'insert_data'])->name('kategoriuseradmin.insert.data')->middleware(['cekrole:2']);
Route::post('/kategoriuseradmin-edit-data', [KategoriUserAdminController::class, 'edit'])->name('kategoriuseradmin.edit.data')->middleware(['cekrole:2']);
Route::post('/kategoriuseradmin-update-data', [KategoriUserAdminController::class, 'update'])->name('kategoriuseradmin.update.data')->middleware(['cekrole:2']);
Route::post('/kategoriuseradmin-delete-data', [KategoriUserAdminController::class, 'destroy'])->name('kategoriuseradmin.delete.data')->middleware(['cekrole:2']);
Route::post('/kategoriuseradmin-detail-data', [KategoriUserAdminController::class, 'detail'])->name('kategoriuseradmin.detail.data')->middleware(['cekrole:2']);

// Jenis Tagihan Perusahaan
Route::get('/jenis_tagihan', [JenisTagihanController::class, 'index'])->name('jenis_tagihan')->middleware(['cekrole:1']);
Route::get('/jenis_tagihan/{id}', [JenisTagihanController::class, 'jenis_tagihan'])->name('jenis_tagihan.jenis')->middleware(['cekrole:1']);
Route::post('/jenis_tagihan-insert-data', [JenisTagihanController::class, 'insert_data'])->name('jenis_tagihan.insert.data')->middleware(['cekrole:1']);
Route::post('/jenis_tagihan-edit-data', [JenisTagihanController::class, 'edit'])->name('jenis_tagihan.edit.data')->middleware(['cekrole:1']);
Route::post('/jenis_tagihan-update-data', [JenisTagihanController::class, 'update'])->name('jenis_tagihan.update.data')->middleware(['cekrole:1']);
Route::post('/jenis_tagihan-delete-data', [JenisTagihanController::class, 'destroy'])->name('jenis_tagihan.delete.data')->middleware(['cekrole:1']);
Route::post('/jenis_tagihan-detail-data', [JenisTagihanController::class, 'detail'])->name('jenis_tagihan.detail.data')->middleware(['cekrole:1']);

// Jenis Tagihan admin
Route::get('/jenis_tagihan_admin', [JenisTagihanAdminController::class, 'index'])->name('jenis_tagihan_admin')->middleware(['cekrole:2,4,5']);
Route::post('/jenis_tagihan_admin-insert-data', [JenisTagihanAdminController::class, 'insert_data'])->name('jenis_tagihan_admin.insert.data')->middleware(['cekrole:2']);
Route::post('/jenis_tagihan_admin-edit-data', [JenisTagihanAdminController::class, 'edit'])->name('jenis_tagihan_admin.edit.data')->middleware(['cekrole:2']);
Route::post('/jenis_tagihan_admin-update-data', [JenisTagihanAdminController::class, 'update'])->name('jenis_tagihan_admin.update.data')->middleware(['cekrole:2']);
Route::post('/jenis_tagihan_admin-delete-data', [JenisTagihanAdminController::class, 'destroy'])->name('jenis_tagihan_admin.delete.data')->middleware(['cekrole:2']);
Route::post('/jenis_tagihan_admin-detail-data', [JenisTagihanAdminController::class, 'detail'])->name('jenis_tagihan_admin.detail.data')->middleware(['cekrole:2']);

// Informasi perusahaan
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi')->middleware(['cekrole:1']);
Route::get('/informasi/{id}', [InformasiController::class, 'informasi'])->name('informasi.jenis')->middleware(['cekrole:1']);
Route::post('/informasi-insert-data', [InformasiController::class, 'insert_data'])->name('informasi.insert.data')->middleware(['cekrole:1']);
Route::post('/informasi-edit-data', [InformasiController::class, 'edit'])->name('informasi.edit.data')->middleware(['cekrole:1']);
Route::post('/informasi-update-data', [InformasiController::class, 'update'])->name('informasi.update.data')->middleware(['cekrole:1']);
Route::post('/informasi-delete-data', [InformasiController::class, 'destroy'])->name('informasi.delete.data')->middleware(['cekrole:1']);
Route::post('/informasi-detail-data', [InformasiController::class, 'detail'])->name('informasi.detail.data')->middleware(['cekrole:1']);

// Data User Profile perusahaan
Route::get('/user', [UserController::class, 'index'])->name('user')->middleware(['cekrole:1']);
Route::get('/user/{id}', [UserController::class, 'user'])->name('user.insert')->middleware(['cekrole:1']);
Route::post('/user-insert-data', [UserController::class, 'insert_data'])->name('user.insert.data')->middleware(['cekrole:1']);
Route::post('/user-edit-data', [UserController::class, 'edit'])->name('user.edit.data')->middleware(['cekrole:1']);
Route::post('/user-update-data', [UserController::class, 'update'])->name('user.update.data')->middleware(['cekrole:1']);
Route::post('/user-delete-data', [UserController::class, 'destroy'])->name('user.delete.data')->middleware(['cekrole:1']);

// Data User Profile admin
Route::get('/user_admin', [UserAdminController::class, 'index'])->name('user_admin')->middleware(['cekrole:2']);
Route::post('/user_admin-insert-data', [UserAdminController::class, 'insert_data'])->name('user_admin.insert.data')->middleware(['cekrole:2']);
Route::post('/user_admin-edit-data', [UserAdminController::class, 'edit'])->name('user_admin.edit.data')->middleware(['cekrole:2']);
Route::post('/user_admin-update-data', [UserAdminController::class, 'update'])->name('user_admin.update.data')->middleware(['cekrole:2']);
Route::post('/user_admin-delete-data', [UserAdminController::class, 'destroy'])->name('user_admin.delete.data')->middleware(['cekrole:2']);

// Informasi admin
Route::get('/informasi_admin', [InformasiAdminController::class, 'index'])->name('informasi_admin')->middleware(['cekrole:2,4,5,8']);
Route::post('/informasi_admin-insert-data', [InformasiAdminController::class, 'insert_data'])->name('informasi_admin.insert.data')->middleware(['cekrole:2,4,8']);
Route::post('/informasi_admin-edit-data', [InformasiAdminController::class, 'edit'])->name('informasi_admin.edit.data')->middleware(['cekrole:2,4']);
Route::post('/informasi_admin-update-data', [InformasiAdminController::class, 'update'])->name('informasi_admin.update.data')->middleware(['cekrole:2,4,8']);
Route::post('/informasi_admin-delete-data', [InformasiAdminController::class, 'destroy'])->name('informasi_admin.delete.data')->middleware(['cekrole:2,4,8']);
Route::post('/informasi_admin-detail-data', [InformasiAdminController::class, 'detail'])->name('informasi_admin.detail.data')->middleware(['cekrole:2,4,8']);

// Histori Kesehatan Perusahaan
Route::get('/history_sehat', [HistorySehatController::class, 'index'])->name('history_sehat')->middleware(['cekrole:1']);
Route::get('/history_sehat/{id}', [HistorySehatController::class, 'history_sehat'])->name('history_sehat.jenis')->middleware(['cekrole:1']);
Route::post('/history_sehat-insert-data', [HistorySehatController::class, 'insert_data'])->name('history_sehat.insert.data')->middleware(['cekrole:1']);
Route::post('/history_sehat-edit-data', [HistorySehatController::class, 'edit'])->name('history_sehat.edit.data')->middleware(['cekrole:1']);
Route::post('/history_sehat-update-data', [HistorySehatController::class, 'update'])->name('history_sehat.update.data')->middleware(['cekrole:1']);
Route::post('/history_sehat-delete-data', [HistorySehatController::class, 'destroy'])->name('history_sehat.delete.data')->middleware(['cekrole:1']);
Route::post('/history_sehat-detail-data', [HistorySehatController::class, 'detail'])->name('history_sehat.detail.data')->middleware(['cekrole:1']);

// Histori Kesehatan Admin
Route::get('/history_sehat_admin', [HistorySehatAdminController::class, 'index'])->name('history_sehat_admin')->middleware(['cekrole:2,5,10']);
Route::post('/history_sehat_admin-insert-data', [HistorySehatAdminController::class, 'insert_data'])->name('history_sehat_admin.insert.data')->middleware(['cekrole:2,10']);
Route::post('/history_sehat_admin-edit-data', [HistorySehatAdminController::class, 'edit'])->name('history_sehat_admin.edit.data')->middleware(['cekrole:2,10']);
Route::post('/history_sehat_admin-update-data', [HistorySehatAdminController::class, 'update'])->name('history_sehat_admin.update.data')->middleware(['cekrole:2,10']);
Route::post('/history_sehat_admin-delete-data', [HistorySehatAdminController::class, 'destroy'])->name('history_sehat_admin.delete.data')->middleware(['cekrole:2,10']);
Route::post('/history_sehat_admin-detail-data', [HistorySehatAdminController::class, 'detail'])->name('history_sehat_admin.detail.data')->middleware(['cekrole:2,10']);

// Histori Kesehatan Merchant
Route::get('/history_sehat_merchant', [HistorySehatMerchantController::class, 'index'])->name('history_sehat_merchant')->middleware(['cekrole:3']);
Route::post('/history_sehat_merchant-insert-data', [HistorySehatMerchantController::class, 'insert_data'])->name('history_sehat_merchant.insert.data')->middleware(['cekrole:3']);
Route::post('/history_sehat_merchant-edit-data', [HistorySehatMerchantController::class, 'edit'])->name('history_sehat_merchant.edit.data')->middleware(['cekrole:3']);
Route::post('/history_sehat_merchant-update-data', [HistorySehatMerchantController::class, 'update'])->name('history_sehat_merchant.update.data')->middleware(['cekrole:3']);
Route::post('/history_sehat_merchant-delete-data', [HistorySehatMerchantController::class, 'destroy'])->name('history_sehat_merchant.delete.data')->middleware(['cekrole:3']);
Route::post('/history_sehat_merchant-detail-data', [HistorySehatMerchantController::class, 'detail'])->name('history_sehat_merchant.detail.data')->middleware(['cekrole:3']);


// Laporan Bayar User perusahaan
Route::get('/laporan_pembayaran_user', [LapUserController::class, 'index'])->name('laporan_pembayaran_user')->middleware(['cekrole:1']);
Route::get('/laporan_pembayaran_user/{tgl_awal}/{tgl_akhir}', [LapUserController::class, 'CetakLaporanUser'])->name('laporan_pembayaran_user_pertanggal')->middleware(['cekrole:1']);

// Laporan Mutasi Merchant admin
Route::get('/mutasi_merchant_admin', [MutasiMerchantAdminController::class, 'index'])->name('mutasi_merchant_admin')->middleware(['cekrole:2,5']);
Route::get('/mutasi_merchant_admin_cetak', [MutasiMerchantAdminController::class, 'mutasi'])->name('mutasi_merchant_admin.pertanggal')->middleware(['cekrole:2,5']);

// Laporan Mutasi User admin
Route::get('/mutasi_rekening_admin', [MutasiRekeningAdminController::class, 'index'])->name('mutasi_rekening_admin')->middleware(['cekrole:2,5']);
Route::get('/mutasi_rekening_admin_cetak', [MutasiRekeningAdminController::class, 'mutasi'])->name('mutasi_rekening_admin.pertanggal')->middleware(['cekrole:2,5']);

// Laporan Mutasi Per User
Route::get('/mutasi_rekening_per_user', [MutasiRekeningPerUserController::class, 'index'])->name('mutasi_rekening_per_user')->middleware(['cekrole:2,5']);
Route::get('/mutasi_rekening_per_user_cetak', [MutasiRekeningPerUserController::class, 'mutasi'])->name('mutasi_rekening_per_user_cetak')->middleware(['cekrole:2,5']);

// Laporan Mutasi Merchant merchant
Route::get('/mutasi_merchantku', [MutasiMerchantMerchantController::class, 'index'])->name('mutasi_merchantku')->middleware(['cekrole:3']);
Route::get('/mutasi_merchantku_cetak', [MutasiMerchantMerchantController::class, 'mutasi'])->name('mutasi_merchantku.pertanggal')->middleware(['cekrole:3']);

// Laporan Mutasi User merchant
Route::get('/mutasi_rekening_merchant', [MutasiRekeningMerchantController::class, 'index'])->name('mutasi_rekening_merchant')->middleware(['cekrole:3']);
Route::get('/mutasi_rekening_merchant_cetak', [MutasiRekeningMerchantController::class, 'mutasi'])->name('mutasi_rekening_merchant.pertanggal')->middleware(['cekrole:3']);

// Laporan Mutasi Merchant perusahaan
Route::get('/mutasi_merchant', [MutasiMerchantController::class, 'index'])->name('mutasi_merchant')->middleware(['cekrole:1']);
Route::get('/mutasi_merchant/{id}', [MutasiMerchantController::class, 'mutasi_rek'])->name('mutasi_merchant.mutasi')->middleware(['cekrole:1']);
Route::get('/mutasi_merchant_cetak', [MutasiMerchantController::class, 'mutasi'])->name('mutasi_merchant.pertanggal')->middleware(['cekrole:1']);

// Laporan Mutasi User perusahaan
Route::get('/mutasi_rekening', [MutasiRekeningController::class, 'index'])->name('mutasi_rekening')->middleware(['cekrole:1']);
Route::get('/mutasi_rekening/{id}', [MutasiRekeningController::class, 'mutasi_rek'])->name('mutasi_rekening.mutasi')->middleware(['cekrole:1']);
Route::get('/mutasi_rekening_cetak', [MutasiRekeningController::class, 'mutasi'])->name('mutasi_rekening.pertanggal')->middleware(['cekrole:1']);
// Route::get('/mutasi_rekening_cetak_data', [MutasiRekeningController::class, 'mutasi_cetak'])->name('mutasi_rekening_cetak.pertanggal')->middleware(['cekrole:1']);

// Bank perusahaan
Route::get('/bank_admin', [BankAdminController::class, 'index'])->name('bank_admin')->middleware(['cekrole:2']);

// Bank perusahaan
Route::get('/bank', [BankController::class, 'index'])->name('bank')->middleware(['cekrole:1']);
Route::post('/bank-insert-data', [BankController::class, 'insert_data'])->name('bank.insert.data')->middleware(['cekrole:1']);
Route::post('/bank-edit-data', [BankController::class, 'edit'])->name('bank.edit.data')->middleware(['cekrole:1']);
Route::post('/bank-update-data', [BankController::class, 'update'])->name('bank.update.data')->middleware(['cekrole:1']);
Route::post('/bank-delete-data', [BankController::class, 'destroy'])->name('bank.delete.data')->middleware(['cekrole:1']);
Route::post('/bank-detail-data', [BankController::class, 'detail'])->name('bank.detail.data')->middleware(['cekrole:1']);

//download format import
Route::get('/download/{filename}', [UserCardController::class, 'download'])->name('download.file')->middleware(['cekrole:1,2']);

// user perusahaan
Route::get('/usercard', [UserCardController::class, 'index'])->name('usercard')->middleware(['cekrole:1']);
Route::get('/usercard/user/{id}', [UserCardController::class, 'user'])->name('usercard.user')->middleware(['cekrole:1']);
Route::post('/usercard-insert-data', [UserCardController::class, 'insert_data'])->name('usercard.insert.data')->middleware(['cekrole:1']);
Route::post('/usercard-edit-data', [UserCardController::class, 'edit'])->name('usercard.edit.data')->middleware(['cekrole:1']);
Route::post('/usercard-update-data', [UserCardController::class, 'update'])->name('usercard.update.data')->middleware(['cekrole:1']);
Route::post('/usercard-delete-data', [UserCardController::class, 'destroy'])->name('usercard.delete.data')->middleware(['cekrole:1']);
Route::post('/usercard-detail-data', [UserCardController::class, 'detail'])->name('usercard.detail.data')->middleware(['cekrole:1']);
Route::get('/usercard/flexcode/checkreg', [UserCardController::class, 'checkreg'])->name('checkreg')->middleware(['cekrole:1']);
Route::get('/usercard/flexcode/register', [UserCardController::class, 'register'])->name('register')->middleware(['cekrole:1']);
Route::get('/usercard/flexcode/getac', [UserCardController::class, 'getac'])->name('getac')->middleware(['cekrole:1']);
Route::get('/usercardku/{id}', [UserCardController::class, 'import'])->name('import.user')->middleware(['cekrole:1,2']);

// user card admin
Route::get('/usercardadmin', [UserCardAdminController::class, 'index'])->name('usercardadmin')->middleware(['cekrole:2,4,5']);
// Route::get('/usercardadmin/user/{id}', [UserCardAdminController::class, 'user'])->name('usercardadmin.user')->middleware(['cekrole:2']);
Route::post('/usercardadmin-insert-data', [UserCardAdminController::class, 'insert_data'])->name('usercardadmin.insert.data')->middleware(['cekrole:2']);
Route::post('/usercardadmin-edit-data', [UserCardAdminController::class, 'edit'])->name('usercardadmin.edit.data')->middleware(['cekrole:2']);
Route::post('/usercardadmin-update-data', [UserCardAdminController::class, 'update'])->name('usercardadmin.update.data')->middleware(['cekrole:2']);
Route::post('/usercardadmin-delete-data', [UserCardAdminController::class, 'destroy'])->name('usercardadmin.delete.data')->middleware(['cekrole:2']);
Route::post('/usercardadmin-detail-data', [UserCardAdminController::class, 'detail'])->name('usercardadmin.detail.data')->middleware(['cekrole:2']);
Route::get('/usercardadminku/{id}', [UserCardAdminController::class, 'import'])->name('import.user')->middleware(['cekrole:1,2']);

//lembaga perusahaan
Route::post('/getlembaga', [UserCardController::class, 'getlembaga'])->name('getlembaga')->middleware(['cekrole:1,2']);

// Export perusahaan
Route::get('/usercard_export', [UserCardController::class, 'export'])->name('usercard.export')->middleware(['cekrole:1,2']);

// Import perusahaan
// Route::get('/importuser', [ImportUserController::class, 'index'])->name('importuser')->middleware(['perusahaan']);
Route::post('/importdatauser', [ImportUserController::class, 'import'])->name('import.datauser')->middleware(['cekrole:1,2']);

// merchant perusahaan
Route::get('/merchant', [MerchantController::class, 'index'])->name('merchant')->middleware(['cekrole:1']);
Route::get('/merchant/merchant/{id}', [MerchantController::class, 'merchant'])->name('merchant.merchant')->middleware(['cekrole:1']);
Route::post('/merchant-insert-data', [MerchantController::class, 'insert_data'])->name('merchant.insert.data')->middleware(['cekrole:1']);
Route::post('/merchant-edit-data', [MerchantController::class, 'edit'])->name('merchant.edit.data')->middleware(['cekrole:1']);
Route::post('/merchant-update-data', [MerchantController::class, 'update'])->name('merchant.update.data')->middleware(['cekrole:1']);
Route::post('/merchant-delete-data', [MerchantController::class, 'destroy'])->name('merchant.delete.data')->middleware(['cekrole:1']);
Route::post('/merchant-detail-data', [MerchantController::class, 'detail'])->name('merchant.detail.data')->middleware(['cekrole:1']);

// merchant admin
Route::get('/merchantadmin', [MerchantAdminController::class, 'index'])->name('merchantadmin')->middleware(['cekrole:2,5']);
Route::post('/merchantadmin-insert-data', [MerchantAdminController::class, 'insert_data'])->name('merchantadmin.insert.data')->middleware(['cekrole:2']);
Route::post('/merchantadmin-edit-data', [MerchantAdminController::class, 'edit'])->name('merchantadmin.edit.data')->middleware(['cekrole:2']);
Route::post('/merchantadmin-update-data', [MerchantAdminController::class, 'update'])->name('merchantadmin.update.data')->middleware(['cekrole:2']);
Route::post('/merchantadmin-delete-data', [MerchantAdminController::class, 'destroy'])->name('merchantadmin.delete.data')->middleware(['cekrole:2']);
Route::post('/merchantadmin-detail-data', [MerchantAdminController::class, 'detail'])->name('merchantadmin.detail.data')->middleware(['cekrole:2']);

// merchant Merchant
Route::get('/merchantmerchant', [MerchantMerchantController::class, 'index'])->name('merchantmerchant')->middleware(['cekrole:3']);
// Route::post('/merchantmerchant-insert-data', [MerchantMerchantController::class, 'insert_data'])->name('merchantmerchant.insert.data')->middleware(['cekrole:3']);
Route::post('/merchantmerchant-edit-data', [MerchantMerchantController::class, 'edit'])->name('merchantmerchant.edit.data')->middleware(['cekrole:3']);
Route::post('/merchantmerchant-update-data', [MerchantMerchantController::class, 'update'])->name('merchantmerchant.update.data')->middleware(['cekrole:3']);
// Route::post('/merchantmerchant-delete-data', [MerchantMerchantController::class, 'destroy'])->name('merchantmerchant.delete.data')->middleware(['cekrole:3']);
Route::post('/merchantmerchant-detail-data', [MerchantMerchantController::class, 'detail'])->name('merchantmerchant.detail.data')->middleware(['cekrole:3']);

// Lembaga Perusahaan
Route::get('/lembaga', [LembagaController::class, 'index'])->name('lembaga')->middleware(['cekrole:1,2']);
Route::get('/lembaga/lembaga/{id}', [LembagaController::class, 'lembaga'])->name('lembaga.lembaga')->middleware(['cekrole:1,2']);
Route::get('/lembaga/detail/{id}', [LembagaController::class, 'detail'])->name('lembaga.detail')->middleware(['cekrole:1,2']);
Route::post('/lembaga-insert-data', [LembagaController::class, 'insert_data'])->name('lembaga.insert.data')->middleware(['cekrole:1,2']);
Route::post('/lembaga-edit-data', [LembagaController::class, 'edit'])->name('lembaga.edit.data')->middleware(['cekrole:1,2']);
Route::post('/lembaga-update-data', [LembagaController::class, 'update'])->name('lembaga.update.data')->middleware(['cekrole:1,2']);
Route::post('/lembaga-delete-data', [LembagaController::class, 'destroy'])->name('lembaga.delete.data')->middleware(['cekrole:1,2']);
Route::post('/lembaga-detail-data', [LembagaController::class, 'detail'])->name('lembaga.detail.data')->middleware(['cekrole:1,2']);

// Lembaga Admin
Route::get('/lembaga_admin', [LembagaAdminController::class, 'index'])->name('lembaga_admin')->middleware(['cekrole:2,5']);
Route::get('/lembaga_admin/detail/{id}', [LembagaAdminController::class, 'detail'])->name('lembaga_admin.detail')->middleware(['cekrole:2,5']);
Route::post('/lembaga_admin-insert-data', [LembagaAdminController::class, 'insert_data'])->name('lembaga_admin.insert.data')->middleware(['cekrole:2']);
Route::post('/lembaga_admin-edit-data', [LembagaAdminController::class, 'edit'])->name('lembaga_admin.edit.data')->middleware(['cekrole:2']);
Route::post('/lembaga_admin-update-data', [LembagaAdminController::class, 'update'])->name('lembaga_admin.update.data')->middleware(['cekrole:2']);
Route::post('/lembaga_admin-delete-data', [LembagaAdminController::class, 'destroy'])->name('lembaga_admin.delete.data')->middleware(['cekrole:2']);
Route::post('/lembaga_admin-detail-data', [LembagaAdminController::class, 'detail'])->name('lembaga_admin.detail.data')->middleware(['cekrole:2']);

// Kelas Perusahaan
Route::post('/kelas-insert-data', [KelasController::class, 'insert_data'])->name('kelas.insert.data')->middleware(['cekrole:1,2']);
Route::post('/kelas-edit-data', [KelasController::class, 'edit'])->name('kelas.edit.data')->middleware(['cekrole:1,2']);
Route::post('/kelas-update-data', [KelasController::class, 'update'])->name('kelas.update.data')->middleware(['cekrole:1,2']);
Route::post('/kelas-delete-data', [KelasController::class, 'destroy'])->name('kelas.delete.data')->middleware(['cekrole:1,2']);

// Transaksi Pembayaran Perusahaan
Route::get('/transaksi_pembayaran', [TransaksiPembayaranController::class, 'index'])->name('transaksi_pembayaran')->middleware(['cekrole:1']);
Route::get('/transaksi_pembayaran/transaksi_pembayaran/{id}', [TransaksiPembayaranController::class, 'transaksi_pembayaran'])->name('transaksi_pembayaran.merchant')->middleware(['cekrole:1']);
Route::get('/transaksi_pembayaran/transaksi_pembayaran/detail_pembayaran/{id}', [TransaksiPembayaranController::class, 'pembayaran_detail'])->name('pembayaran_detail')->middleware(['cekrole:1']);

// Transaksi Pembayaran Admin
Route::get('/transaksi_pembayaran_admin', [TransaksiPembayaranAdminController::class, 'index'])->name('transaksi_pembayaran_admin')->middleware(['cekrole:2']);
// Route::get('/transaksi_pembayaran_admin/transaksi_pembayaran_admin/{id}', [TransaksiPembayaranAdminController::class, 'transaksi_pembayaran_admin'])->name('transaksi_pembayaran_admin.merchant')->middleware(['cekrole:2']);
Route::get('/transaksi_pembayaran_admin/transaksi_pembayaran_admin/detail_pembayaran/{id}', [TransaksiPembayaranAdminController::class, 'pembayaran_detail'])->name('pembayaran_detail')->middleware(['cekrole:2']);

// Transaksi Merchant perusahaan
Route::get('/transaksi_merchant', [TransaksiMerchantController::class, 'index'])->name('transaksi_merchant')->middleware(['cekrole:1']);
Route::get('/transaksi_merchant/transaksi_merchant/{id}', [TransaksiMerchantController::class, 'transaksi_merchant'])->name('transaksi_merchant.merchant')->middleware(['cekrole:1']);
Route::get('/transaksi_merchant/transaksi_merchant/detail_merchant/{id}', [TransaksiMerchantController::class, 'merchant_detail'])->name('merchant_detail')->middleware(['cekrole:1']);

// Transaksi Merchant admin
Route::get('/transaksi_merchant_admin', [TransaksiMerchantAdminController::class, 'index'])->name('transaksi_merchant_admin')->middleware(['cekrole:2,5']);
Route::get('/transaksi_merchant_admin/detail_merchant/{id}', [TransaksiMerchantAdminController::class, 'merchant_detail'])->name('merchant_detail')->middleware(['cekrole:2,5']);

// Transaksi Merchant merchant
Route::get('/transaksi_merchant_merchant', [TransaksiMerchantMerchantController::class, 'index'])->name('transaksi_merchant_merchant')->middleware(['cekrole:3']);
Route::get('/transaksi_merchant_merchant/detail_merchant/{id}', [TransaksiMerchantMerchantController::class, 'merchant_detail'])->name('merchant_detail')->middleware(['cekrole:3']);

// Saldo Merchant admin
Route::get('/saldo_merchant_admin', [SaldoMerchantAdminController::class, 'index'])->name('saldo_merchant_admin')->middleware(['cekrole:2,5']);

// Saldo Merchant Merchant
Route::get('/saldo_merchant_merchant', [SaldoMerchantMerchantController::class, 'index'])->name('saldo_merchant_merchant')->middleware(['cekrole:3,5']);

// Saldo Merchant perusahaan
Route::get('/saldo_merchant', [SaldoMerchantController::class, 'index'])->name('saldo_merchant')->middleware(['cekrole:1']);
Route::get('/saldo_merchant/saldo/{id}', [SaldoMerchantController::class, 'saldo'])->name('merchant.merchant')->middleware(['cekrole:1']);

// Saldo User admin
Route::get('/saldousercardadmin', [SaldoUserCardAdminController::class, 'index'])->name('saldousercardadmin')->middleware(['cekrole:2,4,5,3,10']);

// Saldo User Merchant
Route::get('/saldousercardmerchant', [SaldoUserCardMerchantController::class, 'index'])->name('saldousercardmerchant')->middleware(['cekrole:2,3,5']);

// Saldo User perusahaan
Route::get('/saldousercard', [SaldoUserCardController::class, 'index'])->name('saldousercard')->middleware(['cekrole:1']);
Route::get('/saldousercard/saldo/{id}', [SaldoUserCardController::class, 'saldo'])->name('usercard.user')->middleware(['cekrole:1']);

// Device Perusahaan
Route::get('/device', [DeviceController::class, 'index'])->name('device')->middleware(['cekrole:1,2']);
Route::get('/device/device/{id}', [DeviceController::class, 'device'])->name('device.device')->middleware(['cekrole:1,2']);
Route::post('/device-insert-data', [DeviceController::class, 'insert_data'])->name('device.insert.data')->middleware(['cekrole:1,2']);
Route::post('/device-edit-data', [DeviceController::class, 'edit'])->name('device.edit.data')->middleware(['cekrole:1,2']);
Route::post('/device-update-data', [DeviceController::class, 'update'])->name('device.update.data')->middleware(['cekrole:1,2']);
Route::post('/device-delete-data', [DeviceController::class, 'destroy'])->name('device.delete.data')->middleware(['cekrole:1,2']);
Route::post('/device-detail-data', [DeviceController::class, 'detail'])->name('device.detail.data')->middleware(['cekrole:1,2']);

// Device Admin
Route::get('/device_admin', [DeviceAdminController::class, 'index'])->name('device_admin')->middleware(['cekrole:1,2']);
Route::post('/device_admin-insert-data', [DeviceAdminController::class, 'insert_data'])->name('device_admin.insert.data')->middleware(['cekrole:1,2']);
Route::post('/device_admin-edit-data', [DeviceAdminController::class, 'edit'])->name('device_admin.edit.data')->middleware(['cekrole:1,2']);
Route::post('/device_admin-update-data', [DeviceAdminController::class, 'update'])->name('device_admin.update.data')->middleware(['cekrole:1,2']);
Route::post('/device_admin-delete-data', [DeviceAdminController::class, 'destroy'])->name('device_admin.delete.data')->middleware(['cekrole:1,2']);
Route::post('/device_admin-detail-data', [DeviceAdminController::class, 'detail'])->name('device_admin.detail.data')->middleware(['cekrole:1,2']);

// Master Tagihan perusahaan
Route::get('/master_tagihan', [Master_tagihanController::class, 'index'])->name('master_tagihan')->middleware(['cekrole:1']);
Route::get('/master_tagihan/master/{id}', [Master_tagihanController::class, 'master'])->name('master_tagihan.master')->middleware(['cekrole:1']);
Route::get('/master_tagihan/tagihan/{id}', [Master_tagihanController::class, 'tagihan'])->name('master_tagihan.tagihan')->middleware(['cekrole:1']);
Route::get('/master_tagihan/detail/{id}', [Master_tagihanController::class, 'detail'])->name('master_tagihan.detail')->middleware(['cekrole:1']);
Route::post('/master_tagihan-edit-data', [Master_tagihanController::class, 'edit'])->name('master_tagihan.edit.data')->middleware(['cekrole:1']);
Route::post('/master_tagihan-insert-data', [Master_tagihanController::class, 'insert_data'])->name('master_tagihan.insert.data')->middleware(['cekrole:1']);
Route::post('/master_tagihan-update-data', [Master_tagihanController::class, 'update'])->name('master_tagihan.update.data')->middleware(['cekrole:1']);
Route::post('/master_tagihan-delete-data', [Master_tagihanController::class, 'destroy'])->name('master_tagihan.delete.data')->middleware(['cekrole:1']);
Route::post('/master_tagihan-publish-data', [Master_tagihanController::class, 'publish'])->name('master_tagihan.publish.data')->middleware(['cekrole:1']);

// Master Tagihan admin
Route::get('/master_tagihan_admin', [Master_tagihanAdminController::class, 'index'])->name('master_tagihan_admin')->middleware(['cekrole:2,5']);
Route::get('/master_tagihan_admin/tagihan/{id}', [Master_tagihanAdminController::class, 'tagihan'])->name('master_tagihan_admin.tagihan')->middleware(['cekrole:2,5']);
Route::get('/master_tagihan_admin/detail/{id}', [Master_tagihanAdminController::class, 'detail'])->name('master_tagihan_admin.detail')->middleware(['cekrole:2,5']);
Route::post('/master_tagihan_admin-edit-data', [Master_tagihanAdminController::class, 'edit'])->name('master_tagihan_admin.edit.data')->middleware(['cekrole:2']);
Route::post('/master_tagihan_admin-insert-data', [Master_tagihanAdminController::class, 'insert_data'])->name('master_tagihan_admin.insert.data')->middleware(['cekrole:2']);
Route::post('/master_tagihan_admin-update-data', [Master_tagihanAdminController::class, 'update'])->name('master_tagihan_admin.update.data')->middleware(['cekrole:2']);
Route::post('/master_tagihan_admin-delete-data', [Master_tagihanAdminController::class, 'destroy'])->name('master_tagihan_admin.delete.data')->middleware(['cekrole:2']);
Route::post('/master_tagihan_admin-publish-data', [Master_tagihanAdminController::class, 'publish'])->name('master_tagihan_admin.publish.data')->middleware(['cekrole:2']);
Route::post('/master_tagihan_admin-paste-data', [Master_tagihanAdminController::class, 'paste_data'])->name('master_tagihan_admin.paste.data')->middleware(['cekrole:2']);



// Tagihan User perusahaan
Route::get('/tagihan_user', [Tagihan_userController::class, 'index'])->name('tagihan_user')->middleware(['cekrole:1']);
Route::get('/tagihan_user/tagihan/{id}', [Tagihan_userController::class, 'tagihan'])->name('tagihan_user.tagihan')->middleware(['cekrole:1']);
Route::get('/tagihan_export', [Tagihan_userController::class, 'export'])->name('tagihan_userku.export')->middleware(['cekrole:1']);
Route::get('/tagihan_user/tagihan/bayar/{id}', [Tagihan_userController::class, 'bayar'])->name('tagihan_user.bayar')->middleware(['cekrole:1']);
Route::get('/tagihan_user/detail/{id}', [Tagihan_userController::class, 'detail'])->name('tagihan_user.detail')->middleware(['cekrole:1']);
Route::put('/tagihan_user-insert-data', [Tagihan_userController::class, 'insert'])->name('tagihan_user.insert.data')->middleware(['cekrole:1']);
Route::get('/tagihan_user/cetak/{id}', [Tagihan_userController::class, 'cetak'])->name('tagihan_user.cetak')->middleware(['cekrole:1']);

// Tagihan User admin
Route::get('/tagihan_user_admin', [Tagihan_userAdminController::class, 'index'])->name('tagihan_user_admin')->middleware(['cekrole:2,4,5']);
Route::get('/tagihan_export', [Tagihan_userAdminController::class, 'export'])->name('tagihan_user_admin.export')->middleware(['cekrole:2,5']);
Route::get('/tagihan_user_admin/tagihan/bayar/{id}', [Tagihan_userAdminController::class, 'bayar'])->name('tagihan_user_admin.bayar')->middleware(['cekrole:2,5']);
Route::get('/tagihan_user_admin/detail/{id}', [Tagihan_userAdminController::class, 'detail'])->name('tagihan_user_admin.detail')->middleware(['cekrole:2,4,5']);
Route::put('/tagihan_user_admin-insert-data', [Tagihan_userAdminController::class, 'insert'])->name('tagihan_user_admin.insert.data')->middleware(['cekrole:2,5']);
Route::get('/tagihan_user_admin/cetak/{id}', [Tagihan_userAdminController::class, 'cetak'])->name('tagihan_user_admin.cetak')->middleware(['cekrole:2,5']);
Route::delete('/tagihan_user_admin/delete', [Tagihan_userAdminController::class, 'destroy'])->name('tagihan_user_admin.destroy')->middleware(['cekrole:2']);
Route::delete('/tagihan_user_admin/reversal', [Tagihan_userAdminController::class, 'reversal'])->name('tagihan_user_admin.reversal')->middleware(['cekrole:2']);


//pencairan user card
Route::post('/tagihan-user-card-select', [Tagihan_userAdminController::class, 'getUserCard'])->name('tagihan.usercard.select')->middleware(['cekrole:2,10']);


// Detail Tagihan perusahaan
Route::post('/det_tagihan-edit-data', [Det_tagihanController::class, 'edit'])->name('det_tagihan.edit.data')->middleware(['cekrole:1']);
Route::post('/det_tagihan-insert-data', [Det_tagihanController::class, 'insert_data'])->name('det_tagihan.insert.data')->middleware(['cekrole:1']);
Route::post('/det_tagihan-update-data', [Det_tagihanController::class, 'update'])->name('det_tagihan.update.data')->middleware(['cekrole:1']);
Route::post('/det_tagihan-delete-data', [Det_tagihanController::class, 'destroy'])->name('det_tagihan.delete.data')->middleware(['cekrole:1']);

// Detail Tagihan admin
Route::post('/det_tagihan-edit-data', [Det_tagihanAdminController::class, 'edit'])->name('det_tagihan.edit.data')->middleware(['cekrole:2']);
Route::post('/det_tagihan_admin-edit-data', [Det_tagihanAdminController::class, 'edit'])->name('det_tagihan_admin.edit.data')->middleware(['cekrole:2']);
Route::post('/det_tagihan_admin-insert-data', [Det_tagihanAdminController::class, 'insert_data'])->name('det_tagihan_admin.insert.data')->middleware(['cekrole:2']);
Route::post('/det_tagihan_admin-update-data', [Det_tagihanAdminController::class, 'update'])->name('det_tagihan_admin.update.data')->middleware(['cekrole:2']);
Route::post('/det_tagihan_admin-delete-data', [Det_tagihanAdminController::class, 'destroy'])->name('det_tagihan_admin.delete.data')->middleware(['cekrole:2']);

// verify
Route::get('user/{userId}/verify-fingerprint', [\App\Http\Controllers\UserCardAdminController::class, 'verifyFingerprint'])->name('user.verify-fingerprint');
Route::post('user/verify-fingerprint', [\App\Http\Controllers\UserCardAdminController::class, 'processVerifyFingerprint'])->name('user.process-verify-fingerprint');

// register
Route::get('user/{userId}/register-fingerprint', [\App\Http\Controllers\UserCardAdminController::class, 'registerFingerprint'])->name('user.register-fingerprint');
Route::post('user/{userId}/register-fingerprint', [\App\Http\Controllers\UserCardAdminController::class, 'processRegisterFingerprint'])->name('user.process-register-fingerprint');

// get device
Route::get('device-ac-sn-by-vc', [UserCardAdminController::class, 'getDeviceAcSnByVc'])->name('device.get-device-ac-sn-by-vc');

// banner
Route::get('banner/{id}', [BannerController::class, 'index'])->name('banner');

// banner
Route::get('privacy', [PrivacyController::class, 'index'])->name('privacy');

//pencairan user card
Route::post('/kesehatan-user-card-select', [HistorySehatAdminController::class, 'getUserCard'])->name('sehat.usercard.select')->middleware(['cekrole:2,10,5']);
// Route::post('/user-name', [HistorySehatAdminController::class, 'getUserName'])->name('getusername');

//pencairan user card
Route::post('/pencairan-user-card-select', [PencairanController::class, 'getUserCard'])->name('pencairan.usercard.select')->middleware(['cekrole:2,5']);
Route::get('/pencairan-user-card', [PencairanController::class, 'index'])->name('pencairan.usercard')->middleware(['cekrole:2,5']);
Route::post('/pencairan-user-card-insert-data', [PencairanController::class, 'insert_data'])->name('pencairan.usercard.insert.data')->middleware(['cekrole:2,5']);
// Route::post('/pencairan-user-card-edit-data', [PencairanController::class, 'edit'])->name('pencairan.usercard.edit.data')->middleware(['cekrole:2,4']);
// Route::post('/pencairan-user-card-update-data', [PencairanController::class, 'update'])->name('pencairan.usercard.update.data')->middleware(['cekrole:2,4']);
// Route::post('/pencairan-user-card-delete-data', [PencairanController::class, 'destroy'])->name('pencairan.usercard.delete.data')->middleware(['cekrole:2,4']);
// Route::post('/pencairan-user-card-detail-data', [PencairanController::class, 'detail'])->name('pencairan.usercard.detail.data')->middleware(['cekrole:2,4']);
Route::get('/pencairan-user-card-saldo/{id}', [PencairanController::class, 'cek_saldo'])->name('pencairan.usercard.print.saldo')->middleware(['cekrole:2,5']);
Route::get('/pencairan-user-card-print/{id}', [PencairanController::class, 'print'])->name('pencairan.usercard.print.data')->middleware(['cekrole:2,5']);
Route::post('/reversal-pencairan-user-card', [PencairanController::class, 'reversal'])->name('reversal.data.pencairan.user.card')->middleware(['cekrole:2']);



// pencairan merchant
Route::post('/pencairan-merchant-select', [PencairanMerchantController::class, 'getMerchant'])->name('pencairan.merchant.select')->middleware(['cekrole:2,5']);
Route::get('/pencairan-merchant', [PencairanMerchantController::class, 'index'])->name('pencairan.merchant')->middleware(['cekrole:2,5']);
Route::post('/pencairan-merchant-insert-data', [PencairanMerchantController::class, 'insert_data'])->name('pencairan.merchant.insert.data')->middleware(['cekrole:2,5']);
Route::get('/pencairan-merchant-print/{id}', [PencairanMerchantController::class, 'print'])->name('pencairan.merchant.print.data')->middleware(['cekrole:2,5']);
Route::get('/pencairan-merchant-saldo/{id}', [PencairanMerchantController::class, 'cek_saldo'])->name('pencairan.merchant.print.saldo')->middleware(['cekrole:2,5']);
Route::post('/reversal-pencairan-merchant', [PencairanMerchantController::class, 'reversal'])->name('reversal.data.pencairan.merchant')->middleware(['cekrole:2']);


Route::get('/pencairan-merchant-print/{id}', [PencairanMerchantController::class, 'print'])->name('pencairan.merchant.print.data')->middleware(['cekrole:2,5']);
// Route::post('/pencairan-merchant-edit-data', [PencairanMerchantController::class, 'edit'])->name('pencairan.merchant.edit.data')->middleware(['cekrole:2,4']);
// Route::post('/pencairan-merchant-update-data', [PencairanMerchantController::class, 'update'])->name('pencairan.merchant.update.data')->middleware(['cekrole:2,4']);
// Route::post('/pencairan-merchant-delete-data', [PencairanMerchantController::class, 'destroy'])->name('pencairan.merchant.delete.data')->middleware(['cekrole:2,4']);
// Route::post('/pencairan-merchant-detail-data', [PencairanMerchantController::class, 'detail'])->name('pencairan.merchant.detail.data')->middleware(['cekrole:2,4']);

//data topup
Route::get('/data-topup', [DataTopUpController::class, 'index'])->name('data.topup')->middleware(['cekrole:2']);
Route::post('/topup-user-card-select', [DataTopUpController::class, 'getUserCard'])->name('topup.usercard.select')->middleware(['cekrole:2,5']);
Route::get('/data-topup/data-topup-data', [DataTopUpController::class, 'data_topup'])->name('data.topup.data')->middleware(['cekrole:2']);
Route::post('/reversal-topup', [DataTopUpController::class, 'reversal'])->name('reversal.data.topup')->middleware(['cekrole:2,5']);

//Data Transaksi User
Route::get('/data-transaksi-user', [DataTransaksiUserController::class, 'index'])->name('data.transaksi')->middleware(['cekrole:2']);
Route::post('/transaksi-user-card-select', [DataTransaksiUserController::class, 'getUserCard'])->name('transaksi.usercard.select')->middleware(['cekrole:2,5']);
Route::get('/data-transaksi/data-transaksi-data', [DataTransaksiUserController::class, 'data_transaksi'])->name('data.transaksi.data')->middleware(['cekrole:2']);
Route::post('/reversal-transaksi', [DataTransaksiUserController::class, 'reversal'])->name('reversal.data.transaksi')->middleware(['cekrole:2']);


Route::get('/tambah_tagihan/{id}', [Master_tagihanAdminController::class, 'tambah_tagihan'])->name('tambah_tagihan')->middleware(['cekrole:2']);
Route::post('/tagihan-user-card-select/kategori/{id}', [Master_tagihanAdminController::class, 'getUserCard'])->name('tagihan.usercard.select.kategori')->middleware(['cekrole:2']);
Route::post('/simpan_tagihan', [Master_tagihanAdminController::class, 'tambah_tagihan_user'])->name('tambah_tagihan_user')->middleware(['cekrole:2']);


Route::get('/ajm', [AnjunganMandiriController::class, 'index'])->name('anjungan.mandiri')->middleware('guest');
Route::post('/ajm/result', [AnjunganMandiriController::class, 'result_ajm'])->name('anjungan.mandiri.result')->middleware('guest');

// kas keluar
Route::get('/kaskeluar', [KasKeluarController::class, 'index'])->name('kas.keluar')->middleware(['cekrole:3']);
Route::post('/kaskeluar/user-card', [KasKeluarController::class, 'user_card'])->name('kas.keluar.usercard')->middleware(['cekrole:3']);
Route::post('/kaskeluar/proses', [KasKeluarController::class, 'store'])->name('kas.keluar.proses')->middleware(['cekrole:3']);




Route::get('/autodebet', [AutoDebetBayarController::class, 'index'])->name('autodebet')->middleware('guest');
