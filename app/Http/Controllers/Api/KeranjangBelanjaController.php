<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangBelanjaController extends Controller
{
    public function show()
    {
        $produk = DB::table('keranjang_belanjas')
            ->select(['produks.*','kategoris.nama_kategori', 'keranjang_belanjas.jumlah', 'keranjang_belanjas.total_harga', 'users.name as nama_merchant'])
            ->join('produks', 'produks.id', '=', 'keranjang_belanjas.id_produk')
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->get();

        return response()->json($produk);
    }

    public function delete(Request $request) {
        DB::table('keranjang_belanjas')
            ->where('id', '=', $request->id)
            ->delete();
        return response()->json(['success' => TRUE]);
    }
}
