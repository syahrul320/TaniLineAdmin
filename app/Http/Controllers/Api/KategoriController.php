<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function show()
    {
        $kategori = DB::table('kategoris')
            ->get('*');
        return response()->json($kategori);
    }
}
