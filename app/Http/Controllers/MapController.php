<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class MapController extends Controller
{
    public function index(Request $request)
    {
        $locations  = User::where('level', 'merchant')
            ->get();        
        return view('map.index', compact('locations'));
    }
}
