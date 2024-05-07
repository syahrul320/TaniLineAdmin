<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LokasiMerchantController extends Controller
{
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'longitude' => 'required',
                'latitude' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $user = User::findOrFail($id);
            $user->update([
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
            ]);

            return response()->json($user, $status = 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
