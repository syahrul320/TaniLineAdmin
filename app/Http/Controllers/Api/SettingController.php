<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function showSetting($id)
    {
        $setting = DB::table('users')
            ->where('users.id', '=', $id)
            ->select('users.*')
            ->get();
        return response()->json($setting);
    }
}
