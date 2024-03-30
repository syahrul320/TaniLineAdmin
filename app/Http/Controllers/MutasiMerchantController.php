<?php

namespace App\Http\Controllers;

use App\Exports\LaporanMerchantExport;
use App\Exports\MutasiMerchantExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MutasiMerchantController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('level', 'merchant')->get(['id','name']);
        return view('mutasi_merchant.index', compact('users'));
    }

    public function export(Request $request)
    {
        $id = $request->id;
        return Excel::download(new MutasiMerchantExport($id), 'Mutasi Merchant.xlsx');
    }
}
