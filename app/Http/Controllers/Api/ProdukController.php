<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function show($id)
    {
        $produk = DB::table('produks')
            ->where('produks.id_user_merchant', '=', $id)
            ->select(['nama_produk', 'users.name', 'kategoris.nama_kategori', 'produks.id'])
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->orderByDesc('produks.id')
            ->paginate(30);
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
