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
            ->select(['produks.nama_produk','produks.image', 'stok', 'keranjang_belanjas.id','kategoris.nama_kategori', 'keranjang_belanjas.jumlah', 'keranjang_belanjas.keterangan', 'keranjang_belanjas.harga','keranjang_belanjas.total_harga', 'users.name as nama_merchant'])
            ->join('produks', 'produks.id', '=', 'keranjang_belanjas.id_produk')
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->where('keranjang_belanjas.id_user', '=', $id_user)
            ->get();
        $data = [];
        foreach ($produk as $p) {
            $data[] = [
                'id' => $p->id,
                'nama_produk' => $p->nama_produk,
                'image' => $p->image,
                'nama_kategori' => $p->nama_kategori,
                'jumlah' => $p->jumlah > $p->stok ? "Jumlah Melebihi Stok": $p->jumlah,
                'keterangan' => $p->keterangan,
                'harga' => $p->jumlah > $p->stok ? "0": $p->harga,
                'total_harga' =>  $p->jumlah > $p->stok ? 0: $p->total_harga,
                'nama_merchant' => $p->nama_merchant
            ];
        }

        return response()->json($data);
    }

    public function destroy(Request $request) {
        DB::table('keranjang_belanjas')
            ->where('id', '=', $request->id)
            ->delete();
        return response()->json(['success' => TRUE]);
    }

    public function store(Request $request)
    {
        $keranjang_cek = KeranjangBelanja::where('id_produk', $request->id_produk)->where('id_user', $request->id_user)->first();
        if($keranjang_cek){
            $keranjang_cek->jumlah = $keranjang_cek->jumlah + $request->jumlah;
            $keranjang_cek->total_harga = $keranjang_cek->total_harga + $request->harga*$request->jumlah;
            $keranjang_cek->save();
        }else{
            $keranjang = new KeranjangBelanja();
            $keranjang->id_user = $request->id_user;
            $keranjang->id_produk = $request->id_produk;
            $keranjang->jumlah = $request->jumlah;
            $keranjang->id_user_merchant = $request->id_user_merchant;
            $keranjang->harga = $request->harga;
            $keranjang->total_harga = $request->harga*$request->jumlah;
            $keranjang->keterangan = $request->keterangan;
            $keranjang->save();
        }
        return response()->json(['success' => TRUE]);
    }
}
