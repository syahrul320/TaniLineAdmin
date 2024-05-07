<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KeranjangBelanja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangBelanjaController extends Controller
{
    public function show($id_user)
    {
        $produk = DB::table('keranjang_belanjas')
            ->select(['produks.nama_produk','produks.image', 'keranjang_belanjas.id','kategoris.nama_kategori', 'keranjang_belanjas.jumlah', 'keranjang_belanjas.total_harga', 'users.name as nama_merchant'])
            ->join('produks', 'produks.id', '=', 'keranjang_belanjas.id_produk')
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->where('keranjang_belanjas.id_user', '=', $id_user)
            ->get();

        return response()->json($produk);
    }

    public function destroy(Request $request) {
        DB::table('keranjang_belanjas')
            ->where('id', '=', $request->id)
            ->delete();
        return response()->json(['success' => TRUE]);
    }

    public function store(Request $request)
    {
        $keranjang = new KeranjangBelanja();
        $keranjang->id_user = $request->id_user;
        $keranjang->id_produk = $request->id_produk;
        $keranjang->jumlah = $request->jumlah;
        $keranjang->id_user_merchant = $request->id_user_merchant;
        $keranjang->harga = $request->harga;
        $keranjang->total_harga = $request->harga*$request->jumlah;
        $keranjang->keterangan = $request->keterangan;
        $keranjang->save();
        return response()->json(['success' => TRUE]);
    }
}
