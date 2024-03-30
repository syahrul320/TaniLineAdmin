<?php

namespace App\Http\Controllers;

use App\Models\Cashout;
use App\Models\MutasiMerchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CashOutMerchantController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Cashout::join('users', 'cashouts.id_user_merchant', '=', 'users.id')
                ->select('cashouts.*', 'users.name as nama_merchant')
                ->where('level', '=', 'merchant')
                ->get();
            return DataTables::of($data)->addColumn('actions', function ($row) {
                $button = '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" onclick= destroy("' . encrypt($row->id) . '") ><ion-icon name="trash-outline"></ion-icon></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="cashout-merchant-cetak/' . encrypt($row->id) . '" target="_blank"><ion-icon name="print-outline"></ion-icon></a>';
                
                return $button;
            })
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->removeColumn('id')
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('cashout.index');
    }

    public function saldo(Request $request)
    {
        try {
            $saldo = User::where('id', $request->id)->select("saldo")->first();
            echo "Rp.", number_format($saldo->saldo, 0, ',', '.');
        } catch (\Throwable $th) {
            echo "Rp. 0";
        }
    }

    public function print($id){
        $user = User::join('cashouts', 'cashouts.id_user_merchant', '=', 'users.id')
            ->select('cashouts.*', 'users.name as nama_merchant')
            ->where('cashouts.id', decrypt($id))
            ->first();
        return view('cashout.cetak', compact('user'));
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user_merchant' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $user = User::select('saldo')->where('id', $request->id_user_merchant)->first();

        if ($user->saldo <= $request->jumlah) {
            return response()->json(['errors' => ['jumlah' => ['Saldo tidak mencukupi']]]);
        } else {
            $cashout = new Cashout();
            $cashout->id_user_merchant = $request->id_user_merchant;
            $cashout->jumlah = $request->jumlah;
            $cashout->keterangan = $request->keterangan;
            $cashout->save();

            $user = User::where('id', $request->id_user_merchant)->first();
            $user->saldo = $user->saldo - $request->jumlah;
            $user->save();

            MutasiMerchant::create([
                'id_user_merchant' => $request->id_user_merchant,
                'debet' => $request->jumlah,
                'kredit' => 0,
                'keterangan' => "Cashout ".$request->keterangan,
            ]);

            return response()->json(['success' => 'Cashout added successfully.']);
        }
    }

    public function destroy(Request $request)
    {
        $id = decrypt($request->id);
        $cashout = Cashout::find($id);
        $user = User::where('id', $cashout->id_user_merchant)->first();
        $user->saldo = $user->saldo + $cashout->jumlah;
        $user->save();
        $mutasi = MutasiMerchant::create([
            'id_user_merchant' => $cashout->id_user_merchant,
            'debet' => 0,
            'kredit' => $cashout->jumlah,
            'keterangan' => "Refund Cashout ".$cashout->keterangan,
        ]);
        $cashout->delete();
        return response()->json(['success' => 'Cashout deleted successfully.']);
    }
}
