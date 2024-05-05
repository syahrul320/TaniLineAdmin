<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KeranjangBelanja;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function show($id)
    {
        $pesanan = DB::table('transaksis')
            ->select(['id','kode_transaksi','tgl_transaksi', 'total'])->where('id_user_pembeli',$id)->where('id_user_pembeli', $id)->get();
        return response()->json($pesanan);
    }

    public function pesan($id)
    {
        $pesan = KeranjangBelanja::join('produks', 'keranjang_belanjas.id_produk', '=', 'produks.id')
            ->select(['id_produk', 'id_user_merchant'])
            ->where('id_user', $id)
            ->groupBy('id_user_merchant', 'id_produk') // Add 'id_produk' to the GROUP BY clause
            ->get();

        echo json_encode($pesan);

        $setting = DB::table('settings')->first();

        foreach ($pesan as $p) {

        $keranjang = KeranjangBelanja::where('id_user_merchant', $p->id_user_merchant)->get();
        foreach ($keranjang as $k) {
            $transaksi = new Transaksi();
            $transaksi->id_user_pembeli = $p->id_user;
            $transaksi->id_produk = $p->id_produk;
            $transaksi->qty = $p->jumlah;
            $transaksi->harga = $p->harga;
            $transaksi->biaya_admin = $setting->biaya_admin;
            $transaksi->ongkir = $setting->ongkir;
            $transaksi->total =  $setting->biaya_admin + $setting->ongkir;
            $transaksi->save();
        }
        }

    }


    public function detail($id)
    {
        $detail = DB::table('detail_transaksis')
            ->select(['id','id_produk','id_transaksi','qty','subtotal'])->where('id_transaksi',$id)->get();
        return response()->json($detail);
    }
    
}
