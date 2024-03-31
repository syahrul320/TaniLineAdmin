<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginMerchantController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $users = User::where('email', $request->email)->first();
        if ($users->level != 'merchant') {
            return response()->json(['message' => 'Bukan Akun Merchant'], 401);
        }
        if (!Hash::check($request->password, $users->password)) {
            return response()->json(['error' => 'Invalid password'], 401);
        }
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => "unautorize!",
            ]);
        }
        $token = $users->createToken('auth_token')->plainTextToken;
        $user['id'] = $users->id;
        $user['name'] = $users->name;

        return response()->json([
            'id' => $user['id'],
            'name' => $user['name'];                    
            'message' => 'success',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'number_telephone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'level' => 'merchant',
            'saldo' => 0, // Saldo default 0
            'username' => $request->name,
            'nama_merchant' => $request->name,
            'number_telephone' => $request->number_telephone,
            'password' => Hash::make($request->password),
            'alamat'=> $request->alamat,
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
        'message' => 'success',], 200);
    }
}
