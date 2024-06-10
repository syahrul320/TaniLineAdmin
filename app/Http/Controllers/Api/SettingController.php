<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function updateSetting(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'number_telephone' => 'required',
            'alamat' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->nama_merchant = $request->name;
            $user->username = $request->name;
            $user->email = $request->email;
            $user->number_telephone = $request->number_telephone;
            $user->alamat = $request->alamat;
            $user->save();
            return response()->json(['success' => TRUE]);
        }
    }

    public function update_password(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::find($id);
            if (Hash::check($request->password, $user->password)) { 
                $user->fill([
                     'password' => Hash::make($request->new_password)
                 ])->save();
                 return response()->json(['success' => TRUE]);
                } else {
                    return response()->json(['errors' => 'Password lama tidak sesuai']);
                }
        }
    }

    public function update_token(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::find($id);
            $user->token = $request->token;
            $user->save();
            return response()->json(['success' => TRUE]);
        }
    }

    public function show_url_merchant()
    {
        $setting = DB::table('settings')
            ->select('settings.url_merchant')
            ->first();
        return response()->json($setting);
    }
}
