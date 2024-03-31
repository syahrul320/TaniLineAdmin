<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrasiController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'number_telephone' => 'required',
            'alamat' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->number_telephone = $request->number_telephone;
                $user->alamat = $request->alamat;
                $user->password = bcrypt($request->password);
                $user->level = "pembeli";
                $user->save();
                return response()->json(['success' => TRUE]);
        }
    }

    public function update_nama(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::find(2);
            $user->name = $request->name;
            $user->save();
            return response()->json(['success' => TRUE]);
        }
    }

    public function get_nama_pengguna($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update_email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::find(2);
            $user->email = $request->email;
            $user->save();
            return response()->json(['success' => TRUE]);
        }
    }

    public function get_email_pengguna($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }


    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::find(2);
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

    public function get_alamat_pengguna($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update_alamat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alamat' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::find(2);
            $user->alamat = $request->alamat;
            $user->save();
            return response()->json(['success' => TRUE]);
        }
    }


}
