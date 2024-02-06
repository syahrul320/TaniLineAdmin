<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Produk::join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->select(['users.nama_merchant','users.level', 'produks.*', 'kategoris.nama_kategori'])
            ->where('users.level', 'merchant');
            return DataTables::of($data)
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
        }
        return view('produk.index');
    }

    public function getKategori(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $kategori = Kategori::orderby('nama_kategori', 'asc')->select('id', 'nama_kategori')
                ->limit(5)->get();
        } else {
            $kategori = Kategori::orderby('nama_kategori', 'asc')->select('id', 'nama_kategori')
                ->where('nama_kategori', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($kategori as $kategoris) {
            $response[] = array(
                "id" => $kategoris->id,
                "text" => $kategoris->nama_kategori,
            );
        }
        return response()->json($response);
    }

    // public function getMerchant(Request $request)
    // {
    //     $search = $request->search;
    //     if ($search == '') {
    //         $merchant = User::orderby('nama_merchant', 'asc')->select('id', 'nama_merchant')
    //             ->limit(5)->get();
    //     } else {
    //         $merchant = User::orderby('nama_merchant', 'asc')->select('id', 'nama_merchant')
    //             ->where('nama_merchant', 'like', '%' . $search . '%')->limit(5)->get();
    //     }

    //     $response = array();
    //     foreach ($merchant as $merchants) {
    //         $response[] = array(
    //             "id" => $merchants->id,
    //             "text" => $merchants->nama_merchant,
    //         );
    //     }
    //     return response()->json($response);
    // }
}
