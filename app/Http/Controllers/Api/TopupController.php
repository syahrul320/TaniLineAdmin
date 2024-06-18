<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MutasiMerchant;
use App\Models\Topup;
use App\Models\User;
use Illuminate\Http\Request;

class TopupController extends Controller
{
    public function store(Request $request)
    {
        try {
            //code...
            $ch = curl_init();
            $secret_key = 'Basic ' . base64_encode('JDJ5JDEzJE1RNkdlS25vME9ZcFQ5Y3VHZS5HbU80RjdmSXpZNi5JV3c1ZjRYS1RVR3JWb0pnVUV1WHVp:'); // replace 'your_secret_key' with your actual secret key

            curl_setopt($ch, CURLOPT_URL, "https://bigflip.id/api/v2/pwf/bill");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            curl_setopt($ch, CURLOPT_POST, TRUE);

            $payloads = [
                "title" => "Topup Taniline",
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
            $topup->id_user_merchant = $request->id_user_merchant;
            $topup->title = $dataResponse->title;
            $topup->amount = $request->amount;
            $topup->status = 'pending';
            $topup->external_id = $dataResponse->link_id;
            $topup->url = $dataResponse->link_url;
            $topup->save();

            return response()->json(['data' => $dataResponse->link_url]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    function notification(Request $request)
    {
        try {
            //code...
            $response = $request->data;
            $data = json_decode($response);
            $topup = Topup::where('external_id', $data->bill_link_id)->first();

            if ($topup && $topup->status == 'pending') {
                $topup->status = strtolower($data->status);
                $topup->save();
                if ($topup->status == 'successful') {
                    $merchant = User::find($topup->id_user_merchant);
                    $merchant->update([
                        'saldo' => $merchant->saldo + $topup->amount
                    ]);

                    $mutasi = MutasiMerchant::create([
                        'id_user_merchant' => $topup->id_user_merchant,
                        'debet' => $topup->amount,
                        'kredit' => 0,
                        'keterangan' => "TOPUP " . $data->status
                    ]);
                }
            } else {
                return response()->json(['message' => 'Topup not found']);
            }
            return response()->json([$topup]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    public function show_history_topup($id)
    {
        $topup = Topup::where('id_user_merchant', $id)
            ->where('status', 'successful')
            ->orderBy('created_at', 'desc')
            ->select('title', 'amount', 'status', 'created_at')
            ->paginate(10);
        return response()->json($topup);
    }

    public function showHistoryPanding($id)
    {
        $topup = Topup::where('id_user_merchant', $id)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->select('title', 'amount', 'status', 'created_at')
            ->paginate(10);
        return response()->json($topup);
    }
}
