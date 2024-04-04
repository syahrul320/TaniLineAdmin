<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

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
                ->editColumn('created_at', function ($row) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->removeColumn('id')
                ->make(true);
        }
        return view('topup.index');
    }
}
