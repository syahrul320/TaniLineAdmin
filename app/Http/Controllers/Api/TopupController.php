<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topup;
use App\Models\User;
use Illuminate\Http\Request;

class TopupController extends Controller
{
    public function store(Request $request, $id)
    {
        try {
            //code...
            $ch = curl_init();
            $secret_key = 'Basic ' . base64_encode('JDJ5JDEzJE1RNkdlS25vME9ZcFQ5Y3VHZS5HbU80RjdmSXpZNi5JV3c1ZjRYS1RVR3JWb0pnVUV1WHVp:'); // replace 'your_secret_key' with your actual secret key

            curl_setopt($ch, CURLOPT_URL, "https://bigflip.id/big_sandbox_api/v2/pwf/bill");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            curl_setopt($ch, CURLOPT_POST, TRUE);

            $payloads = [
                "title" => $request->title,
                "amount" => $request->amount,
                "type" => "SINGLE",
                "redirect_url" => "https://testing.sidikty.com",
                "is_address_required" => 0,
                "is_phone_number_required" => 0
            ];

            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payloads));

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization:" . $secret_key,
                "Content-Type: application/x-www-form-urlencoded"
            ));

            curl_setopt($ch, CURLOPT_USERPWD, $secret_key . ":");

            $response = curl_exec($ch);
            curl_close($ch);

            $dataResponse = json_decode($response);

            $topup = new Topup();
            $topup->id_user_merchant = $id;
            $topup->title = $request->title;
            $topup->amount = $request->amount;
            $topup->status = 'pending';
            $topup->external_id = $dataResponse->link_id;
            $topup->url = $dataResponse->link_url;
            $topup->save();

            return response()->json([$topup]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    function notification(Request $request)
    {
        $response = $request->data;
        $data = json_decode($response);
        $topup = Topup::where('external_id', $data->bill_link_id)->first();

        if ($topup && $topup->status == 'pending') {
            $topup->status = strtolower($data->status);
            $topup->save();
        }

        // $merchant = User::find($id);
        // $merchant->update([
        //     'saldo' => $merchant->saldo + $request->amount
        // ]);

        return response()->json(['message' => 'success']);
    }
}
