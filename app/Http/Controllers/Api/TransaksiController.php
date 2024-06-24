<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\KeranjangBelanja;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function showTransaksi($id)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.id_user_pembeli', '=', $id)
            ->select(['transaksis.kode_transaksi', 'produks.nama_produk', 'transaksis.qty', 'transaksis.harga', 'transaksis.biaya_admin', 'transaksis.total_biaya', 'transaksis.tgl_transaksi', 'transaksis.status_transaksi'])
            ->join('produks', 'transaksis.id_produk', '=', 'produks.id')
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }

    public function showTransaksiMerchant($id)
    {
        $transaksi_merchant = DB::table('detail_transaksis')
            ->where('detail_transaksis.id_user_merchant', '=', $id)
            ->where('transaksis.status_transaksi', 'diterima')
            ->select([
                'transaksis.kode_transaksi',
                'transaksis.id as id_transaksi',
                'produks.nama_produk',
                'detail_transaksis.qty',
                'produks.image',
                'detail_transaksis.harga_jual',
                'transaksis.tgl_transaksi',
                'transaksis.status_transaksi',
                'transaksis.id_user_merchant',
                'transaksis.total',
                'transaksis.ongkir'
            ])
            ->join('produks', 'detail_transaksis.id_produk', '=', 'produks.id')
            ->join('transaksis', 'detail_transaksis.id_transaksi', '=', 'transaksis.id')
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi_merchant);
    }

    public function detailTransaksiMerchant($id)
    {
        $transaksi_merchant = DB::table('detail_transaksis')
            ->where('transaksis.id', '=', $id)
            ->join('produks', 'detail_transaksis.id_produk', '=', 'produks.id')
            ->join('transaksis', 'detail_transaksis.id_transaksi', '=', 'transaksis.id')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->select([
                'transaksis.kode_transaksi',
                'produks.nama_produk',
                'produks.image',
                'detail_transaksis.qty',
                'detail_transaksis.harga_jual',
                'detail_transaksis.id_transaksi',
                'transaksis.tgl_transaksi',
                'transaksis.id_user_pembeli',
                'users.name as nama_pembeli',
                'transaksis.alamat_tujuan',
                'transaksis.ongkir',
                'transaksis.id',
                'transaksis.total'
            ])
            ->get();
        return response()->json($transaksi_merchant);
    }

    public function showTransaksiByStatus($status, $id)
    {

        $transaksi = DB::table('transaksis')
            ->where('transaksis.status_transaksi', '=', $status)
            ->where('transaksis.id_user_pembeli', '=', $id)
            ->whereDate('transaksis.tgl_transaksi', '>=', now()->subDays(3))
            ->select(['transaksis.*'])
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }

    public function showPesananDiterima($id)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.id_user_merchant', '=', $id)
            ->where('transaksis.status_transaksi', '=', 'diterima')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->select([
                'transaksis.kode_transaksi',
                'users.name as nama_pembeli',
                'transaksis.biaya_admin',
                'transaksis.total_harga',
                'transaksis.tgl_transaksi',
                'transaksis.status_transaksi',
                'transaksis.total',
                'transaksis.id',
                'transaksis.ongkir'
            ])
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }


    public function getDistanceCost(Request $request)
    {
        $id_user = $request->id_user;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $biaya = Setting::find(1);    
        $keranjang_by_penjual = KeranjangBelanja::where('keranjang_belanjas.id_user', '=', $id_user)
            ->join('users', 'keranjang_belanjas.id_user_merchant', '=', 'users.id')
            ->join('produks', 'keranjang_belanjas.id_produk', '=', 'produks.id')
            ->selectRaw('keranjang_belanjas.id_user_merchant, SUM(total_harga) as  total_harga, stok, jumlah, ROUND(( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) )) AS distance', [$latitude, $longitude, $latitude])
            ->groupBy(array('keranjang_belanjas.id_user_merchant','total_harga', 'latitude', 'longitude', 'stok', 'jumlah'))
            ->get();

        $total_barang = 0;
        $distance = 0;
        foreach ($keranjang_by_penjual as $key => $value) {
            if($value->stok < $value->jumlah){
                $distance = 0;
                $total_barang = 0;
                break;
            }else{
                $distance += $value->distance - 1;
                $total_barang += $value->total_harga;
            }
        }
        echo json_encode(array('distance' => $distance, 'ongkir' => $distance * $biaya->ongkir, 'total_barang' => $total_barang, 'total' => $total_barang + ($distance * $biaya->ongkir)));
    }

    public function cancelTransaksi(Request $request)
    {
        $id_transaksi = $request->id_transaksi;
        $transaksi = Transaksi::where('id', $id_transaksi)->first();
        $transaksi->status_transaksi = 'batal';
        $transaksi->save();
        return response()->json(['success' => TRUE]);
    }

    public function showDetailTransaksi($id)
    {

        $detail_transaksi = DB::table('detail_transaksis')
            ->where('detail_transaksis.id_transaksi', '=', $id)
            ->join('produks', 'detail_transaksis.id_produk', '=', 'produks.id')
            ->select(['produks.*', 'detail_transaksis.qty', 'detail_transaksis.keterangan', 'detail_transaksis.harga_jual'])
            ->get();
        return response()->json($detail_transaksi);
    }

    public function store_by_produk(Request $request)
    {
        $biaya = Setting::where('id', 1)->first();
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = 'TRX' . date('is') . "" . date('Ymd') . "" . rand(1000, 9999);
        $transaksi->id_user_pembeli = $request->id_user_pembeli;
        $transaksi->id_user_merchant = $request->id_user_merchant;
        $transaksi->biaya_admin = $biaya->biaya_admin;
        $transaksi->tgl_transaksi = date('Y-m-d H:i:s');
        $transaksi->ongkir = $request->ongkir;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->total = (($request->total_harga) + $request->ongkir);
        $transaksi->status_transaksi = "diterima";
        $transaksi->alamat_tujuan = $request->alamat_tujuan;
        $transaksi->save();

        $transaksi_id = $transaksi->id;
        $detail_transaksi = new DetailTransaksi();
        $detail_transaksi->id_user_merchant = $request->id_user_merchant;
        $detail_transaksi->id_transaksi = $transaksi_id;
        $detail_transaksi->id_produk = $request->id_produk;
        $detail_transaksi->qty = $request->jumlah;
        $detail_transaksi->harga_jual = $request->harga;
        $detail_transaksi->keterangan = $request->keterangan;
        $detail_transaksi->save();

        return response()->json(['success' => TRUE]);
    }

    public function store(Request $request)
    {
        $biaya = DB::table('settings')->where('id', '=', 1)->first();
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $keranjang_by_penjual = DB::table('keranjang_belanjas')
            ->join('users', 'keranjang_belanjas.id_user_merchant', '=', 'users.id')
            ->selectRaw('id_user_merchant, SUM(total_harga) as  total_harga, stok, jumlah, ROUND(( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) )) AS distance', [$latitude, $longitude, $latitude])
            ->where('keranjang_belanjas.id_user', '=', $request->id_user)
            ->where('keranjang_belanjas.jumlah', '<=', 'produks.stok')
            ->join('produks', 'keranjang_belanjas.id_produk', '=', 'produks.id')
            ->groupBy(array('keranjang_belanjas.id_user_merchant','total_harga', 'latitude', 'longitude', 'stok', 'jumlah'))
            ->get();

        foreach ($keranjang_by_penjual as $key => $value) {
            $jarak_harus_bayar = $value->distance - 1;
            $insert_transaksi = new Transaksi();
            $insert_transaksi->kode_transaksi = 'TRX' . date('is') . "" . date('Ymd') . "" . rand(1000, 9999);
            $insert_transaksi->id_user_pembeli = $request->id_user;
            $insert_transaksi->id_user_merchant = $value->id_user_merchant;
            $insert_transaksi->biaya_admin = $biaya->biaya_admin;
            $insert_transaksi->tgl_transaksi = date('Y-m-d H:i:s');
            $insert_transaksi->ongkir = $biaya->ongkir * $jarak_harus_bayar;
            $insert_transaksi->total_harga = $value->total_harga;
            $insert_transaksi->total = ($value->total_harga + ($biaya->ongkir * $jarak_harus_bayar));
            $insert_transaksi->status_transaksi = 'diterima';
            $insert_transaksi->alamat_tujuan = $request->alamat_tujuan;
            $insert_transaksi->save();
            $insert_transaksi_id = $insert_transaksi->id;

            $keranjang = DB::table('keranjang_belanjas')
                ->where('keranjang_belanjas.id_user', '=', $request->id_user)
                ->where('keranjang_belanjas.id_user_merchant', '=', $insert_transaksi->id_user_merchant)
                ->join('produks', 'keranjang_belanjas.id_produk', '=', 'produks.id')
                ->where('produks.stok', '>=', 'keranjang_belanjas.jumlah')
                ->select(['keranjang_belanjas.*', 'keranjang_belanjas.jumlah', 'produks.harga', 'produks.nama_produk', 'produks.stok'])
                ->get();

            foreach ($keranjang as $key => $keranjang) {
                $insert_transaksi_detail = new DetailTransaksi();
                $insert_transaksi_detail->id_user_merchant = $insert_transaksi->id_user_merchant;
                $insert_transaksi_detail->id_transaksi = $insert_transaksi_id;
                $insert_transaksi_detail->id_produk = $keranjang->id_produk;
                $insert_transaksi_detail->qty = $keranjang->jumlah;
                $insert_transaksi_detail->harga_jual = $keranjang->harga;
                $insert_transaksi_detail->keterangan = $keranjang->keterangan;
                $insert_transaksi_detail->save();
                DB::table('keranjang_belanjas')->where('id', '=', $keranjang->id)->delete();
            }
        }
        // $transaksi->save();
        return response()->json(['success' => TRUE]);
        // print_r(json_decode($keranjang_by_penjual));

    }


    public function showPesananSelesai($id)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.id_user_merchant', '=', $id)
            ->where('transaksis.status_transaksi', '=', 'selesai')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->join('detail_transaksis', 'transaksis.id', '=', 'detail_transaksis.id_transaksi')
            ->join('produks', 'detail_transaksis.id_produk', '=', 'produks.id')
            ->select([
                'transaksis.kode_transaksi',
                'users.name as nama_pembeli',
                'transaksis.biaya_admin',
                'transaksis.total_harga',
                'transaksis.tgl_transaksi',
                'transaksis.status_transaksi',
                'transaksis.total',
                'transaksis.ongkir',
                'detail_transaksis.id as id_detail_transaksi',
                'detail_transaksis.qty',
                'produks.nama_produk',
            ])
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }

    public function showBillingselesai($id)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.kode_transaksi', '=', $id)
            ->where('transaksis.status_transaksi', '=', 'selesai')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->join('detail_transaksis', 'transaksis.id', '=', 'detail_transaksis.id_transaksi')
            ->join('produks', 'detail_transaksis.id_produk', '=', 'produks.id')
            ->select([
                'transaksis.kode_transaksi',
                'users.name as nama_pembeli',
                'transaksis.biaya_admin',
                'transaksis.total_harga',
                'transaksis.tgl_transaksi',
                'transaksis.status_transaksi',
                'transaksis.total',
                'transaksis.ongkir',
                'detail_transaksis.id as id_detail_transaksi',
                'detail_transaksis.qty',
                'produks.nama_produk',
            ])
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }

    public function showPesananDiproses($id)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.id_user_merchant', '=', $id)
            ->where('transaksis.status_transaksi', '=', 'diproses')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->select([
                'transaksis.kode_transaksi',
                'users.name as nama_pembeli',
                'transaksis.biaya_admin',
                'transaksis.total_harga',
                'transaksis.tgl_transaksi',
                'transaksis.status_transaksi',
                'transaksis.total',
                'transaksis.ongkir'
            ])
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }

    public function showPesananDibatalkan($id)
    {
        $transaksi = DB::table('transaksis')
            ->where('transaksis.id_user_merchant', '=', $id)
            ->where('transaksis.status_transaksi', '=', 'batal')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->select([
                'transaksis.kode_transaksi',
                'users.name as nama_pembeli',
                'transaksis.biaya_admin',
                'transaksis.total_harga',
                'transaksis.tgl_transaksi',
                'transaksis.status_transaksi',
                'transaksis.total',
                'transaksis.ongkir'
            ])
            ->orderByDesc('transaksis.id')
            ->paginate(30);
        return response()->json($transaksi);
    }

    public function updateStatusTransaksi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status_transaksi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $transaksi = Transaksi::where('id', $id)->first();
        $transaksi->status_transaksi = $request->status_transaksi;
        $transaksi->save();

        return response()->json([
            'message' => 'Status transaksi berhasil diubah',
            'data' => $transaksi
        ]);
    }

    public function notifPesananDiterima($id)
    {
        $transaksi = Transaksi::where('id_user_merchant', $id)
            ->where('notif_pesanan_diterima', 'no')
            ->where('status_transaksi', 'diterima')
            ->first();
        if (!empty($transaksi)) {
            $transaksi->notif_pesanan_diterima = 'yes';
            $transaksi->save();
            return response()->json(['status' => True]);
        } else {
            return response()->json(['status' => False]);
        }
    }

    public function konfirmasiPesananDiterima($id)
    {
        try {
            $transaksi = Transaksi::where('id', $id)
                ->where('status_transaksi', 'diterima')
                ->first();
            $user = User::find($transaksi->id_user_merchant);
            $setting = Setting::find(1);
            $detailproduk = DetailTransaksi::where('id_transaksi', $id)->get();
            if (!empty($transaksi)) {
                if ($user->saldo < $setting->biaya_admin) {
                    return response()->json(['status' => False, 'message' => 'Saldo anda tidak mencukupi']);
                } else {
                    foreach ($detailproduk as $key => $value) {
                        $produk = Produk::find($value->id_produk);
                        $produk->stok -= $value->qty;
                        $produk->save();
                    }
                    $user->saldo -= $setting->biaya_admin;
                    $user->save();
                    $transaksi->status_transaksi = 'diproses';
                    $transaksi->save();
                    return response()->json(['status' => True, 'message' => 'Pesanan berhasil dikonfirmasi']);
                }
            } else {
                return response()->json(['status' => False]);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => False, 'message' => $th->getMessage()]);
        }
    }

    public function notifPesananDikirim($id)
    {
        $transaksi = Transaksi::where('id_user_pembeli', $id)
            ->where('notif_pesanan_dikirim', 'no')
            ->where('status_transaksi', 'diproses')
            ->first();
        if (!empty($transaksi)) {
            $transaksi->notif_pesanan_dikirim = 'yes';
            $transaksi->save();
            return response()->json(['status' => True]);
        } else {
            return response()->json(['status' => False]);
        }
    }
}
