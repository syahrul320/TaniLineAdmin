<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Topup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TopupController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Topup::join('users', 'topups.id_user_merchant', '=', 'users.id')
                ->select(['users.name', 'topups.*'])
                ->where('users.level', 'merchant');
            return DataTables::of($data)
                ->addIndexColumn()
                ->removeColumn('id')
                // ->rawColumns(['actions'])
                ->make(true);
        }
        return view('topup.index');
    }
}
