<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function showTransaksi($id)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.id_user_pembeli', '=', $id)
            ->select(['transaksis.kode_transaksi', 'produks.nama_produk', 'transaksis.qty', 'transaksis.harga', 'transaksis.biaya_admin', 'transaksis.total_biaya', 'transaksis.tgl_transaksi', 'transaksis.status_transaksi'])
            ->join('produks', 'transaksis.id_produk', '=', 'produks.id')
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }


    public function showTransaksiMerchant($id)
    {
        $transaksi_merchant = DB::table('detail_transaksis')
            ->where('detail_transaksis.id_user_merchant', '=', $id)
            ->where('transaksis.status_transaksi', 'diterima')
            ->select([
                'transaksis.kode_transaksi',
                'transaksis.id as id_transaksi',
                'produks.nama_produk',
                'detail_transaksis.qty',
                'produks.image',
                'detail_transaksis.harga_jual',
                'transaksis.tgl_transaksi',
                'transaksis.status_transaksi',
                'transaksis.id_user_merchant',
                'transaksis.total',
                'transaksis.ongkir'
            ])
            ->join('produks', 'detail_transaksis.id_produk', '=', 'produks.id')
            ->join('transaksis', 'detail_transaksis.id_transaksi', '=', 'transaksis.id')
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi_merchant);
    }

    public function detailTransaksiMerchant($kode_transaksi)
    {
        $transaksi_merchant = DB::table('detail_transaksis')
            ->where('transaksis.kode_transaksi', '=', $kode_transaksi)
            ->join('produks', 'detail_transaksis.id_produk', '=', 'produks.id')
            ->join('transaksis', 'detail_transaksis.id_transaksi', '=', 'transaksis.id')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->select([
                'transaksis.kode_transaksi',
                'produks.nama_produk',
                'produks.image',
                'detail_transaksis.qty',
                'detail_transaksis.harga_jual',
                'detail_transaksis.id_transaksi',
                'transaksis.tgl_transaksi',
                'transaksis.id_user_pembeli',
                'users.name as nama_pembeli',
                'users.alamat as alamat_pembeli',
            ])
            ->get();
        return response()->json($transaksi_merchant);
    }

    public function showTransaksiByStatus($status)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.status_transaksi', '=', $status)
            ->select(['transaksis.kode_transaksi', 'produks.nama_produk', 'transaksis.qty', 'transaksis.harga', 'transaksis.biaya_admin', 'transaksis.total_biaya', 'transaksis.tgl_transaksi', 'transaksis.status_transaksi'])
            ->join('produks', 'transaksis.id_produk', '=', 'produks.id')
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }

    public function showPesananDiterima($id)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.id_user_merchant', '=', $id)
            ->where('transaksis.status_transaksi', '=', 'diterima')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->select([
                'transaksis.kode_transaksi',
                'users.name as nama_pembeli',
                'transaksis.biaya_admin',
                'transaksis.total_harga',
                'transaksis.tgl_transaksi',
                'transaksis.status_transaksi',
                'transaksis.total',
                'transaksis.ongkir'
            ])
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }

    public function showPesananSelesai($id)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.kode_transaksi', '=', $id)
            ->where('transaksis.status_transaksi', '=', 'selesai')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->select([
                'transaksis.kode_transaksi',
                'users.name as nama_pembeli',
                'transaksis.biaya_admin',
                'transaksis.total_harga',
                'transaksis.tgl_transaksi',
                'transaksis.status_transaksi',
                'transaksis.total',
                'transaksis.ongkir'
            ])
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }

    public function showPesananDiproses($id)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.id_user_merchant', '=', $id)
            ->where('transaksis.status_transaksi', '=', 'diproses')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->select([
                'transaksis.kode_transaksi',
                'users.name as nama_pembeli',
                'transaksis.biaya_admin',
                'transaksis.total_harga',
                'transaksis.tgl_transaksi',
                'transaksis.status_transaksi',
                'transaksis.total',
                'transaksis.ongkir'
            ])
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }

    public function showPesananDibatalkan($id)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.kode_transaksi', '=', $id)
            ->where('transaksis.status_transaksi', '=', 'batal')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->select([
                'transaksis.kode_transaksi',
                'users.name as nama_pembeli',
                'transaksis.biaya_admin',
                'transaksis.total_harga',
                'transaksis.tgl_transaksi',
                'transaksis.status_transaksi',
                'transaksis.total',
                'transaksis.ongkir'
            ])
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }

    public function updateStatusTransaksi(Request $request, $kode_transaksi)
    {
        $validator = Validator::make($request->all(), [
            'status_transaksi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $transaksi = Transaksi::where('kode_transaksi', $kode_transaksi)->first();
        $transaksi->status_transaksi = $request->status_transaksi;
        $transaksi->save();

        return response()->json([
            'message' => 'Status transaksi berhasil diubah',
            'data' => $transaksi
        ]);
    }
    
}
