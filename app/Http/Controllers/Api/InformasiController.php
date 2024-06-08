<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformasiController extends Controller
{
    public function show()
    {
        $informasi = DB::table('informasis')
            ->get('*');

        $bantuan = Setting::where('id', 1)->first();
        // $informasi ['helpdesk'] = $bantuan->helpdesk;
        return response()->json(array('informasi' => $informasi, 'bantuan' => $bantuan->helpdesk), 200);
    }
}
