<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SaldoMerchantController extends Controller
{
    public function show($id)
    {
        $saldo = DB::table('users')
            ->where('users.id', '=', $id)
            ->select('users.saldo')
            ->get();
        return response()->json($saldo);
    }
}
