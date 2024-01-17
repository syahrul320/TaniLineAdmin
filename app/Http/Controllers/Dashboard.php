<?php

namespace App\Http\Controllers;

use App\Models\Master_tagihan;
use App\Models\Tagihan_user;
use App\Models\Topup;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\UserCard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id_perusahaan;
        $user_card=UserCard::selectRaw('COUNT(*) AS result')->where('status_user','aktif')->where('id_perusahaan', $user)->first()->result;
        $user=User::selectRaw('COUNT(*) AS result')->where('level', '!=','7')->where('id_perusahaan', $user)->first()->result;

        return view('dashboard.index', compact('user','user_card'));
    }

    public function nominal_transaksi(Request $request)
    {

        $user = Auth::user()->id_perusahaan;
        // if ($request->ajax()) {
            $from = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->startOfDay();
            $to = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->endOfDay();
            $data_topup = Topup::selectRaw('SUM(jumlah) AS result')->where('id_perusahaan', $user)->whereDate('tgl_topup', '>=', $from)
            ->whereDate('tgl_topup', '<=', $to)->first()->result;
            $data_tranksaksi = Transaksi::selectRaw('SUM(total_transaksi) AS result')->whereDate('tgl_transaksi', '>=', $from)
            ->whereDate('tgl_transaksi', '<=', $to)->where('id_perusahaan', $user)->first()->result;;
            $data_tagihan_lunas = Tagihan_user::selectRaw('SUM(total) AS result')->join('master_tagihans', 'tagihan_users.id_master_tagihan', 'master_tagihans.id')->where('tagihan_users.status','Lunas')->whereDate('tgl_harus_bayar', '>=', $from)
            ->whereDate('tgl_harus_bayar', '<=', $to)->where('id_perusahaan', $user)->first()->result;
            $data_biaya_admin = Topup::selectRaw('SUM(biaya_admin) AS result')->whereDate('tgl_topup', '>=', $from)
            ->whereDate('tgl_topup', '<=', $to)->where('id_perusahaan', $user)->first()->result;
           
   
            if(empty($data_topup)) { $data_topup =0 ; }
            if(empty($data_tranksaksi)) { $data_tranksaksi =0; }
            if(empty($data_tagihan_lunas)) { $data_tagihan_lunas =0; }
            if(empty($data_biaya_admin)) { $data_biaya_admin =0; }
            $data = array('data_topup'=> $data_topup,
            'data_transaksi' => $data_tranksaksi,
            'data_tagihan_lunas' => $data_tagihan_lunas,
            'data_biaya_admin'=> $data_biaya_admin);


            echo json_encode($data);
        // }


    }
    public function jumlah_transaksi(Request $request)
    {
        $user = Auth::user()->id_perusahaan;
        if ($request->ajax()) {
            $from = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->startOfDay();
            $to = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->endOfDay();
            $data_topup = Topup::selectRaw('COUNT(jumlah) AS result')->whereDate('tgl_topup', '>=', $from)
            ->whereDate('tgl_topup', '<=', $to)->where('id_perusahaan', $user)->first()->result;
            $data_tranksaksi = Transaksi::selectRaw('COUNT(total_transaksi) AS result')->whereDate('tgl_transaksi', '>=', $from)
            ->whereDate('tgl_transaksi', '<=', $to)->where('id_perusahaan', $user)->first()->result;;
            $data_tagihan_lunas = Master_tagihan::selectRaw('COUNT(total) AS result')->join('tagihan_users', 'tagihan_users.id_master_tagihan', 'master_tagihans.id')->where('tagihan_users.status','Lunas')->whereDate('tgl_harus_bayar', '>=', $from)
            ->whereDate('tgl_harus_bayar', '<=', $to)->where('id_perusahaan', $user)->first()->result;
           
   
            if(empty($data_topup)) { $data_topup =0 ; }
            if(empty($data_tranksaksi)) { $data_tranksaksi =0; }
            if(empty($data_tagihan_lunas)) { $data_tagihan_lunas =0; }
            $data = array('data_topup'=> $data_topup,
            'data_transaksi' => $data_tranksaksi,
            'data_tagihan_lunas' => $data_tagihan_lunas);


            echo json_encode($data);
        }

    }
}
