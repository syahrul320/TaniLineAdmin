<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformasiController extends Controller
{
    public function show()
    {
        $informasi = DB::table('informasis')
            ->get('*');
        return response()->json($informasi);
    }
}
