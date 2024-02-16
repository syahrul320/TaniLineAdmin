<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class SaldoMerchantController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('level', 'merchant')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->removeColumn('id')
                // ->rawColumns(['actions'])
                ->make(true);
        }
        return view('saldo_merchant.index');
    }
}
