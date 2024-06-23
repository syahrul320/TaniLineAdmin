<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use Clockwork\Request\Request;

class ProdukController extends Controller
{

    public function list_produk($latitude, $longitude)
    {
        // $produk = DB::table('produks')
        //     ->select('produks.*','kategoris.nama_kategori', 'users.name as nama_merchant')
        //     ->join('users', 'produks.id_user_merchant', '=', 'users.id')
        //     ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
        //     ->leftjoin('detail_transaksis', 'produks.id', '=', 'detail_transaksis.id_produk')
        //     ->groupBy('produks.id')
        //     ->limit(10)
        //     ->get();

        $produk = DB::table('produks')
            ->selectRaw('produks.*, kategoris.nama_kategori, users.name as nama_merchant ,  ROUND(( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) )) AS distance', [$latitude, $longitude, $latitude])
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->groupBy('produks.id')
            ->having('distance', '<', 10)
            ->orderBy('distance')
            ->paginate(10);

        return response()->json($produk);
    }

    public function list_produk_by_kategori($id_kategori ,$latitude, $longitude)
    {
        $produk = DB::table('produks')
            ->selectRaw('produks.*, kategoris.nama_kategori, users.name as nama_merchant ,  ROUND(( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) )) AS distance', [$latitude, $longitude, $latitude])
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->where('kategoris.id', $id_kategori)
            ->groupBy('produks.id')
            ->having('distance', '<', 10)
            ->orderBy('distance')
            ->paginate(10);

        return response()->json($produk);
    }

    public function pencarian($keyword, $latitude, $longitude)
    {
        $produk = DB::table('produks')
                ->selectRaw('produks.*, kategoris.nama_kategori, users.name as nama_merchant ,  ROUND(( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) )) AS distance', [$latitude, $longitude, $latitude])
                ->join('users', 'produks.id_user_merchant', '=', 'users.id')
                ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
                ->where('produks.nama_produk', 'like', '%' . $keyword . '%')
                ->groupBy('produks.id')
                ->having('distance', '<', 10)
                ->orderBy('distance')
                ->paginate(10);
            return response()->json($produk);
    }


    public function pencarian_by_kategori($id_kategori , $keyword, $latitude, $longitude)
    {
        $produk = DB::table('produks')
                ->selectRaw('produks.*, kategoris.nama_kategori, users.name as nama_merchant ,  ROUND(( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) )) AS distance', [$latitude, $longitude, $latitude])
                ->join('users', 'produks.id_user_merchant', '=', 'users.id')
                ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
                ->where('kategoris.id', $id_kategori)
                ->where('produks.nama_produk', 'like', '%' . $keyword . '%')
                ->groupBy('produks.id')
                ->having('distance', '<', 10)
                ->orderBy('distance')
                ->paginate(10);
            return response()->json($produk);
    }


    public function produk_terlaris($latitude, $longitude)
    {
        $produk = DB::table('produks')
            ->selectRaw('produks.id, produks.nama_produk,produks.harga, kategoris.nama_kategori, users.name as nama_merchant, COUNT(produks.id) as total_penjualan, ROUND(( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) )) AS distance', [$latitude, $longitude, $latitude])
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->leftjoin('detail_transaksis', 'produks.id', '=', 'detail_transaksis.id_produk')
            ->orderBy('total_penjualan', 'desc')
            ->groupBy(array('produks.id','produks.nama_produk','produks.harga', 'kategoris.nama_kategori'))
            ->having('distance', '<', 10)
            ->limit(6)
            ->get();

        return response()->json($produk);
    }

    public function detail($id, $latitude, $longitude)
    {
        $setting = DB::table('settings')->first();
        $produk = DB::table('produks')
            ->where('produks.id', '=', $id)
            ->selectRaw('produks.*, kategoris.nama_kategori, users.name as nama_merchant ,  ROUND(( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) )) AS distance', [$latitude, $longitude, $latitude])
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->having('distance', '<', 10)
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->first();
        $produk->ongkir = $setting->ongkir;
        return response()->json($produk);
    }

    public function destroy(Request $request){
        Produk::destroy($request->id);
        return response()->json(['message' => 'Data berhasil dihapus']);
    }

}
