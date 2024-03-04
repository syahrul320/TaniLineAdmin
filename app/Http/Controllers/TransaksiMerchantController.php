<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class TransaksiMerchantController extends Controller
{
    public function index(Request $request)
    {
        $data = Transaksi::join('users', 'transaksis.id_user_pembeli', '=', 'users.id');
        if ($request->ajax()) {
            $produk = $request->id_produk;
            if ($produk != '') {
                $data = $data->where('transaksis.id_produk', $produk);
            }
            if ($request->get('start_date') != "") {

                $from = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->startOfDay();
                $to = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->endOfDay();
                $data =  $data->whereDate('tgl_transaksi', '>=', $from)
                    ->whereDate('tgl_transaksi', '<=', $to);
            }
            $data->join('produks', 'transaksis.id_produk', '=', 'produks.id')
                ->select(['users.name', 'transaksis.*', 'produks.nama_produk'])
                ->where('users.level', 'pembeli');
            return DataTables::of($data)
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
        }
        return view('transaksi_merchant.index');
    }

    public function getProduk(Request $request)
    {
        $search = $request->id_produk;
        if ($search == '') {
            $produk = Produk::orderby('nama_produk', 'asc')->select('id', 'nama_produk')
                ->limit(5)->get();
        } else {
            $produk = Produk::orderby('nama_produk', 'asc')->select('id', 'nama_produk')
                ->where('id_produk', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($produk as $produks) {
            $response[] = array(
                "id" => $produks->id,
                "text" => $produks->nama_produk,
            );
        }
        return response()->json($response);
    }
}
