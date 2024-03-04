<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Topup;
use App\Models\Transaksi;
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

    public function transaksi(Request $request)
    {
        $from = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->startOfDay();
        $to = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->endOfDay();
        $transaksi_selesai = Transaksi::selectRaw('SUM(harga) AS result')
            ->whereBetween('tgl_transaksi', [$from, $to])
            ->where('status_transaksi', 'selesai')
            ->first()->result;
        $transaksi_diproses = Transaksi::selectRaw('SUM(harga) AS result')
            ->whereBetween('tgl_transaksi', [$from, $to])
            ->where('status_transaksi', 'diproses')
            ->first()->result;
        $transaksi_diterima = Transaksi::selectRaw('SUM(harga) AS result')
            ->whereBetween('tgl_transaksi', [$from, $to])
            ->where('status_transaksi', 'diterima')
            ->first()->result;
        $transaksi_batal = Transaksi::selectRaw('SUM(harga) AS result')
            ->whereBetween('tgl_transaksi', [$from, $to])
            ->where('status_transaksi', 'batal')
            ->first()->result;



        if (empty($transaksi_selesai)) {
            $transaksi_selesai = 0;
        }
        if (empty($transaksi_diproses)) {
            $transaksi_diproses = 0;
        }
        if (empty($transaksi_diterima)) {
            $transaksi_diterima = 0;
        }
        if (empty($transaksi_batal)) {
            $transaksi_batal = 0;
        }
        $data = array(
            'transaksi_selesai' => $transaksi_selesai,
            'transaksi_diproses' => $transaksi_diproses,
            'transaksi_diterima' => $transaksi_diterima,
            'transaksi_batal' => $transaksi_batal,
        );


        echo json_encode($data);
    }

    public function topup(Request $request)
    {
        $from = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->startOfDay();
        $to = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->endOfDay();
        $topup = Topup::selectRaw('SUM(jumlah) AS result')
            ->whereBetween('tgl_topup', [$from, $to])
            ->first()->result;
        $biaya_admin = Transaksi::selectRaw('SUM(biaya_admin) AS result')
            ->whereBetween('tgl_transaksi', [$from, $to])
            ->first()->result;

        if (empty($topup)) {
            $topup = 0;
        }
        if (empty($biaya_admin)) {
            $biaya_admin = 0;
        }
        $data = array(
            'topup' => $topup,
            'biaya_admin' => $biaya_admin,
        );

        echo json_encode($data);
    }
}
