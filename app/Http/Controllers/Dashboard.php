<?php

namespace App\Http\Controllers;

use App\Models\Produk;
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

    public function pembayaran(Request $request)
    {
        $from = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->startOfDay();
        $to = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->endOfDay();
        $pendaftaran = User::selectRaw('COUNT(*) AS result')
            // ->where('status_lunas_daftar', 'Lunas')
            ->first()->result;
        // $daftar_ulang = User::selectRaw('COUNT(*) AS result')
        //     ->where('status_lunas_daftar_ulang', 'Lunas')
        //     ->first()->result;

        if (empty($pendaftaran)) {
            $pendaftaran = 0;
        }
        // if (empty($daftar_ulang)) {
        //     $daftar_ulang = 0;
        // }
        $data = array(
            'pendaftaran' => $pendaftaran,
        );


        echo json_encode($data);
    }
}
