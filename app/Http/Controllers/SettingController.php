<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $setting = Setting::all()->first();
        return view('setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::findOrFail($request->id);
        $setting->update([
            'nama_aplikasi' => $request->nama_aplikasi,
            'tgl_expired' => $request->tgl_expired,
            'biaya_admin' => $request->biaya_admin,
            'biaya_kirim' => $request->biaya_kirim,
        ]);
        // return redirect()->back();

        return redirect('setting')->with('success', 'Data berhasil diupdate');
    }
}
