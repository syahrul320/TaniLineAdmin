<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Det_pembayaran;
use App\Models\Det_tagihan;
use App\Models\Jenis_tagihan;
use App\Models\Master_tagihan;
use App\Models\MutasiRek;
use App\Models\MutasiRekMerchant;
use App\Models\Pembayaran_tagihan;
use App\Models\Rekening;
use App\Models\RekeningMerchant;
use App\Models\Tagihan_user;
use Illuminate\Support\Facades\Validator;

class BlankPage extends Controller
{
    public function index()
    {
    }
}
