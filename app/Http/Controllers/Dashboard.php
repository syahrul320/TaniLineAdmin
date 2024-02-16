<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::selectRaw('COUNT(*) AS result')->where('level', 'pembeli')->first()->result;
        $merchant = User::selectRaw('COUNT(*) AS result')->where('level', 'merchant')->first()->result;
        $produk = Produk::selectRaw('COUNT(*) AS result')->first()->result;

        return view('dashboard.index', compact('user', 'merchant', 'produk'));
    }

    public function jumlah_user(Request $request)
    {
        // $from = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->startOfDay();
        // $to = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->endOfDay();
        $pembeli = User::selectRaw('SUM(id) AS result')->where('level', 'pembeli')->first()->result;
        // $data_tranksaksi = Transaksi::selectRaw('SUM(total_transaksi) AS result')->whereDate('tgl_transaksi', '>=', $from)
        //     ->whereDate('tgl_transaksi', '<=', $to)->where('id_perusahaan', $user)->first()->result;;
        // $data_tagihan_lunas = Tagihan_user::selectRaw('SUM(total) AS result')->join('master_tagihans', 'tagihan_users.id_master_tagihan', 'master_tagihans.id')->where('tagihan_users.status', 'Lunas')->whereDate('tgl_harus_bayar', '>=', $from)
        //     ->whereDate('tgl_harus_bayar', '<=', $to)->where('id_perusahaan', $user)->first()->result;
        // $data_biaya_admin = Topup::selectRaw('SUM(biaya_admin) AS result')->whereDate('tgl_topup', '>=', $from)
        //     ->whereDate('tgl_topup', '<=', $to)->where('id_perusahaan', $user)->first()->result;


        if (empty($data_user)) {
            $data_user = 0;
        }
        // if (empty($data_tranksaksi)) {
        //     $data_tranksaksi = 0;
        // }
        // if (empty($data_tagihan_lunas)) {
        //     $data_tagihan_lunas = 0;
        // }
        // if (empty($data_biaya_admin)) {
        //     $data_biaya_admin = 0;
        // }
        $data = array(
            'data_user' => $data_user
            // 'data_transaksi' => $data_tranksaksi,
            // 'data_tagihan_lunas' => $data_tagihan_lunas,
            // 'data_biaya_admin' => $data_biaya_admin
        );
        echo json_encode($data);
    }
}
