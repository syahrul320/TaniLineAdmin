<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function produk_terlaris()
    {
        $produk = DB::table('produks')
            ->select(['produks.*','kategoris.nama_kategori', 'users.name as nama_merchant', DB::raw("COUNT(produks.id) as total_penjualan")])
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->leftjoin('detail_transaksis', 'produks.id', '=', 'detail_transaksis.id_produk')
            ->orderBy('total_penjualan', 'desc')
            ->groupBy('produks.id')
            ->limit(5)
            ->get();

        return response()->json($produk);
    }

    public function detail($id)
    {
        $produk = DB::table('produks')
            ->where('produks.id', '=', $id)
            ->select(['nama_produk', 'users.name', 'kategoris.nama_kategori', 'produks.id'])
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->first();
        return response()->json($produk);
    }
}
