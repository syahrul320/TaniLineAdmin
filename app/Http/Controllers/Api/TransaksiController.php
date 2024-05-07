<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;

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

    public function showDetailTransaksiMerchant($id)
    {
        $detailTransaksi = DetailTransaksi::where('id_transaksi', '=', $id)
            ->join('produks', 'detail_transaksis.id_produk', '=', 'produks.id')
            ->select(['produks.nama_produk', 'produks.image', 'detail_transaksis.*'])
            ->get();
        return response()->json($detailTransaksi);
    }
}
