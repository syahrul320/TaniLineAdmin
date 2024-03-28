<?php

namespace App\Http\Controllers;

use App\Exports\LaporanMerchantExport;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class LaporanMerchantController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('level', 'merchant')->get(['id','name']);
        return view('laporan_merchant.index', compact('users'));
    }

    public function getMerchant(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $merchant = User::orderby('nama_merchant', 'asc')->select('id', 'nama_merchant')
                ->where('level', 'merchant')
                ->limit(5)->get();
            } else {
                $merchant = User::orderby('nama_merchant', 'asc')->select('id', 'nama_merchant')
                ->where('level', 'merchant')
                ->where('id_user_merchant', 'like', '%' . $search . '%')->limit(5)->get();
            }

        $response = array();
        foreach ($merchant as $merchants) {
            $response[] = array(
                "id" => $merchants->id,
                "text" => $merchants->nama_merchant,
            );
        }
        return response()->json($response);
    }

    public function export(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        return Excel::download(new LaporanMerchantExport($id), 'Laporan Merchant.xlsx');
    }
}
