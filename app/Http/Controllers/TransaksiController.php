<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $data = Transaksi::join('users', 'transaksis.id_user_pembeli', '=', 'users.id');
        if ($request->ajax()) {
            $user = $request->id_user;
            if ($user != '') {
                $data = $data->where('transaksis.id_user_pembeli', $user);
            }
            if ($request->get('start_date') != "") {
                $from = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->startOfDay();
                $to = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->endOfDay();
                $data =  $data->whereDate('tgl_transaksi', '>=', $from)
                    ->whereDate('tgl_transaksi', '<=', $to);
            }
            $data->select(['users.name', 'transaksis.*'])
                ->where('users.level', 'pembeli');
            return DataTables::of($data)->addColumn('actions', function ($row) {
                $button = '&nbsp;&nbsp;';
                $button = '<a href="/transaksi-pembeli/transaksi_detail/' . encrypt($row->id) . '" class="btn btn-primary" data-toggle="tooltip"><ion-icon name="newspaper-sharp"></ion-icon> Detail</a>';
                return $button;
            })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['actions', 'code'])
                ->make(true);
        }
        return view('transaksi.index');
    }

    public function transaksi_detail(Request $request)
    {
        if ($request->ajax()) {
            $data = DetailTransaksi::join('users', 'detail_transaksis.id_user_merchant', '=', 'users.id')
                ->join('produks', 'detail_transaksis.id_produk', '=', 'produks.id')
                ->join('transaksis', 'detail_transaksis.id_transaksi', '=', 'transaksis.id')
                ->select('users.name', 'produks.nama_produk', 'detail_transaksis.qty', 'detail_transaksis.harga_jual', 'transaksis.*')
                ->where('users.level', 'merchant');
            return DataTables::of($data)
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
        }
        return view('transaksi.transaksi_detail');
    }

    public function getUser(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $merchant = User::orderby('name', 'asc')->select('id', 'name')
                ->where('level', 'pembeli')
                ->limit(5)->get();
            } else {
                $merchant = User::orderby('name', 'asc')->select('id', 'name')
                ->where('level', 'pembeli')
                ->where('id_user', 'like', '%' . $search . '%')->limit(5)->get();
            }

        $response = array();
        foreach ($merchant as $merchants) {
            $response[] = array(
                "id" => $merchants->id,
                "text" => $merchants->name,
            );
        }
        return response()->json($response);
    }
}
