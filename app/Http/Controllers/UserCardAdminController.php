<?php

namespace App\Http\Controllers;

use App\Exports\UserCardExport;
use App\Models\Device;
use App\Models\Finger;
use App\Models\Rekening;
use App\Models\UserCard;
use App\Models\RekPoling;
use App\Models\Perusahaan;
use App\Models\KategoriUser;
use App\Models\Kelas;
use App\Models\Lembaga;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserCardAdminController extends Controller
{
    public function export()
    {
        return Excel::download(new UserCardExport, 'User.xlsx');
    }

    public function index(Request $request)
    {
        $useradmin = Auth::user()->id_perusahaan;
        $perusahaan = Perusahaan::findOrFail($useradmin);
        $user = UserCard::join('users', 'user_cards.id_user', 'users.id')
            ->get(['users.email', 'users.id', 'user_cards.*']);

        $katergori_user = KategoriUser::get("*");

        $rekening_poling = RekPoling::join('banks', 'rek_polings.id_perusahaan', 'banks.id')->get();
        // $rekening_poling = RekPoling::with('banks')->where('id_perusahaan', '=', decrypt($request->id))->get();
        $lembaga = DB::table('lembagas')
            ->join('perusahaans', 'lembagas.id_perusahaan', 'perusahaans.id')
            ->select('lembagas.*')->get();
        if ($request->ajax()) {
            $data = UserCard::join('users', 'user_cards.id_user', 'users.id')
                ->join('lembagas', 'user_cards.id_lembaga', 'lembagas.id')
                ->join('kelas', 'user_cards.id_kelas', 'kelas.id')
                ->join('rekenings', 'user_cards.id', 'rekenings.id_user_card')
                ->leftJoin('v_a_users', 'v_a_users.id_rekening', '=', 'rekenings.id')
                ->join('kategori_users', 'user_cards.id_kategori_user', 'kategori_users.id')
                ->get(['v_a_users.va', 'users.nis_nip', 'kategori_users.nama_kategori_user', 'users.number_telephone', 'users.email', 'user_cards.*', 'lembagas.nama_lembaga', 'kelas.kelas'])
                ->where('id_perusahaan', $useradmin);
            return DataTables::of($data)->addColumn('actions', function ($row) {
                if (Auth::user()->level == 2) {
                    $button = '';
                    $button .='<div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton'.$row->id.'" data-bs-toggle="dropdown" aria-expanded="false">
                    Options
                    </button>';
                    $button .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton'.$row->id.'">';
                    $button .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" onclick= edit("' . encrypt($row->id) . '") data-original-title="Edit"><ion-icon name="pencil-outline"></ion-icon> Edit</a>';
                    $button .= '<li><a href="javascript:void(0)" onclick= destroy("' . encrypt($row->id) . '") ><ion-icon name="trash-outline"></ion-icon> Delete</a>';
                    if ($row->fingerprints == null) {
                        $button .= '<li><a href="finspot:FingerspotReg;' . base64_encode(route('user.register-fingerprint', $row->id)) . '"><ion-icon name="finger-print-outline"></ion-icon> Register</a>';
                    } else {
                        $button .= '<li><a href="finspot:FingerspotVer;' . base64_encode(route('user.verify-fingerprint', $row->id)) . '"><ion-icon name="finger-print-outline"></ion-icon> Test Login</a>';
                        $button .= '<li><a href="finspot:FingerspotReg;' . base64_encode(route('user.register-fingerprint', $row->id)) . '"><ion-icon name="finger-print-outline"></ion-icon> Register ulang</a>';
                    }
                    if ($row->va == null) {
                        $button .= '<li><a href="javascript:void(0)" onclick= create_va("' . $row->id . '") ><ion-icon name="card-outline"></ion-icon> Create VA</a>';
                    }
                    $button .='</ul>';
                    $button .='</div>';
                } else {
                    $button = '<span class="badge bg-danger">Akses Terbatas</span>';
                }
                return $button;
            })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['actions', 'code'])
                ->make(true);
        }
        return view('user_card_admin.index', ['lembaga' => $lembaga, 'user' => $user, 'perusahaan' => $perusahaan, 'katergori_user' => $katergori_user, 'rekening_poling' => $rekening_poling]);
    }

    public function getlembaga(Request $request)
    {
        $kelas = Kelas::join('lembagas', 'kelas.id_lembaga', 'lembagas.id')
            ->where('kelas.id_lembaga', $request->id_lembaga)
            ->get(['kelas.id', 'kelas.kelas']);
        echo "<option>---Pilih Kelas---</option>";
        foreach ($kelas as $key) {
            if ($request->id_kelas == $key->id) {

                echo "<option value='$key->id' selected>$key->kelas</option>";
            } else {
                echo "<option value='$key->id'>$key->kelas</option>";
            }
        }
    }

    public function import(Request $request)
    {
        $perusahaan = Perusahaan::findOrFail(decrypt($request->id));
        $rekening_poling = RekPoling::join('banks', 'rek_polings.id_perusahaan', 'banks.id')->get();
        $lembaga = Lembaga::where('id_perusahaan', decrypt($request->id))->get();
        $kategori = KategoriUser::where('id_perusahaan', decrypt($request->id))->get();
        return view('user_card.import', ['rekening_poling' => $rekening_poling, 'kategori' => $kategori, 'perusahaan' => $perusahaan, 'lembaga' => $lembaga]);
    }

    public function download($filename = '')
    {
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() . "/app/downloads/" . $filename;
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=' . $filename,
        );
        if (file_exists($file_path)) {
            // Send Download
            return response($file_path, $filename, $headers);
            // return \Response::download( $file_path, $filename, $headers );
        } else {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_usercard' => 'required',
            'nis_nip' => 'required|unique:users',
            'id_perusahaan' => 'required',
            'jk' => 'required',
            'id_lembaga' => 'required',
            'id_kelas' => 'required',
            'nohp' => 'required|numeric',
            'alamat' => 'required',
            'password' => 'required',
            'username' => 'required',
            'id_kategori_user' => 'required',
            'id_rek_poling' => 'required',
            'status_user' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            $user = User::create([
                'name' => $request->nama_usercard,
                'email' => $request->email,
                'number_telephone' => $request->nohp,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'nis_nip' => $request->nis_nip,
                'id_perusahaan' => decrypt($request->id_perusahaan),
                'level' => '7',
            ]);

            $usercard = UserCard::create([
                'nama_usercard' => $request->nama_usercard,
                'id_perusahaan' => decrypt($request->id_perusahaan),
                'jk' => $request->jk,
                'id_lembaga' => $request->id_lembaga,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'id_kategori_user' => $request->id_kategori_user,
                'id_user' => $user->id,
                'barcode' => $request->nis_nip,
                'limit_harian' => $request->limit_harian,
                'status_user' => $request->status_user,
                'total_belanja_sekarang' => '0',
                'tanggal_sekarang' => Date('Y-m-d'),
            ]);

            $rekening = Rekening::create([
                'id_user_card' => $usercard->id,
                'id_perusahaan' => decrypt($request->id_perusahaan),
                'id_rek_poling' => $request->id_rek_poling,
                'saldo_awal' => 0,
                'saldo_akhir' => 0,
            ]);

            return response()->json(['success' => TRUE]);
        }
    }

    public function edit(Request $request)
    {
        $user = DB::table('user_cards')
            ->join('users', 'user_cards.id_user', 'users.id')
            ->select('users.*', 'user_cards.*')
            ->where('user_cards.id', decrypt($request->id))->first();
        return response()->json(['data' => $user]);
    }

    public function detail(Request $request)
    {
        $usercard = UserCard::findOrFail(decrypt($request->id));
        return response()->json(['data' => $usercard]);
    }

    public function update(Request $request)
    {
        $usercard = UserCard::findOrFail($request->id);
        $user = User::where('id', $usercard->id_user);
        $validator = Validator::make($request->all(), [
            'nama_usercard' => 'required',
            'nis_nip' => 'required|unique:users,nis_nip,' . $user->first()->id,
            'id_perusahaan' => 'required',
            'jk' => 'required',
            'id_lembaga' => 'required',
            'id_kelas' => 'required',
            'nohp' => 'required|numeric',
            'alamat' => 'required',
            'username' => 'required',
            'id_kategori_user' => 'required',
            'status_user' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            if ($request->password != null) {
                $user->update([
                    'name' => $request->nama_usercard,
                    'email' => $request->email,
                    'number_telephone' => $request->nohp,
                    'username' => $request->username,
                    'nis_nip' => $request->nis_nip,
                    'password' => Hash::make($request->password),
                ]);
                $usercard->update([
                    'nama_usercard' => $request->nama_usercard,
                    'jk' => $request->jk,
                    'id_lembaga' => $request->id_lembaga,
                    'id_kelas' => $request->id_kelas,
                    'alamat' => $request->alamat,
                    'id_kategori_user' => $request->id_kategori_user,
                    'status_user' => $request->status_user,
                    'limit_harian' => $request->limit_harian,
                    'barcode' => $request->nis_nip,
                ]);
            } else {
                $user->update([
                    'name' => $request->nama_usercard,
                    'email' => $request->email,
                    'number_telephone' => $request->nohp,
                    'username' => $request->username,
                    'nis_nip' => $request->nis_nip,
                    // 'password' => Hash::make($request->password),
                ]);
                $usercard->update([
                    'nama_usercard' => $request->nama_usercard,
                    'jk' => $request->jk,
                    'id_lembaga' => $request->id_lembaga,
                    'id_kelas' => $request->id_kelas,
                    'alamat' => $request->alamat,
                    'id_kategori_user' => $request->id_kategori_user,
                    'status_user' => $request->status_user,
                    'limit_harian' => $request->limit_harian,
                    'barcode' => $request->nis_nip,
                ]);
            }
        }
        return response()->json(['success' => TRUE]);
    }

    public function destroy(Request $request)
    {
        $usercard = UserCard::findOrFail(decrypt($request->id));
        $user = User::where('id', $usercard->id_user);
        $usercard->delete();
        $user->delete();
        return response()->json(['success' => 'Usercard deleted successfully.']);
    }

    public function checkreg()
    {
        $cek = Finger::select(DB::raw("COUNT(*) as ct"))
            ->where('user_card_id', '=', $_GET['user_card_id'])->first();
        if (intval($cek->ct) > intval($_GET['current'])) {
            $res['result'] = true;
            $res['current'] = intval($cek->ct);
        } else {
            $res['result'] = false;
        }
        echo json_encode($res);
    }

    // public function cekFinger($id)
    // {
    //     $finger             = getUserFinger($id);
    //     $register            = '';
    //     $verification        = '';
    //     $url_register        = base64_encode($base_path . "?user_card_id=" . $row['user_card_id']);
    //     $url_verification    = base64_encode($base_path . "?user_card_id=" . $row['user_card_id']);
    // }


    function getUserFinger($id)
    {
        $cek = Finger::query();
        $i = 0;
        foreach ($cek as $key) {
            $arr[$i] = array(
                "user_card_id" => $key->user_card_id,
                "finger_id" => $key->finger_id,
                "finger_data" => $key->finger_data
            );
            $i++;
        }
    }

    function register()
    {
        echo $_GET['user_card_id'] . ";SecurityKey;15;" . "usercard/flexcode/process_register;usercard/flexcode/getac";
    }

    function process_register()
    {
        if (isset($_POST['RegTemp']) && !empty($_POST['RegTemp'])) {
            $data = explode(";", $_POST['RegTemp']);
            $vStamp = $data[0];
            $sn = $data[1];
            $user_card_id = $data[2];
            $regTemp = $data[3];

            $device = $this->getDeviceBySn($sn);

            $salt = md5($device[0]['ac'] . $device[0]['vkey'] . $regTemp . $sn . $user_card_id);

            if (strtoupper($vStamp) == strtoupper($salt)) {

                $sql1 = Finger::select(DB::raw("MAX(*) as fid"))
                    ->where('user_card_id', '=', '$user_card_id')->first();
                $fid = $sql1->fid;

                if ($fid == 0) {
                    $insert = Finger::create([
                        'user_card_id' => $user_card_id,
                        'finger_id' => ($fid + 1),
                        'finger_data' => $regTemp,
                    ]);
                    if ($insert) {
                        $res['result'] = true;
                    } else {
                        $res['server'] = "Error insert registration data!";
                    }
                } else {
                    $res['result'] = false;
                    $res['user_finger_' . $user_card_id] = "Template already exist.";
                }

                echo "empty";
            } else {
                echo $msg = "Parameter invalid..";
            }
        }
    }

    function getac()
    {
        $data = Device::get();
        $i = 0;
        foreach ($data as $row) {
            $arr[$i] = array(
                'device_name' => $row->device_name,
                'sn' => $row->sn,
                'vc' => $row->vc,
                'ac' => $row->ac,
                'vkey' => $row->vkey
            );

            $i++;
        }
        echo $arr[0]['ac'] . $arr[0]['sn'];
    }

    function getDeviceBySn($sn)
    {
        $sql = Device::get();
        $arr = array();
        $i = 0;

        foreach ($sql as $row) {
            $arr[$i] = array(
                'device_name' => $row->device_name,
                'sn' => $row->sn,
                'vc' => $row->vc,
                'ac' => $row->ac,
                'vkey' => $row->vkey
            );
            $i++;
        }

        return $arr;
    }

    public function registerFingerprint($userId)
    {
        $time_limit_reg = 15;
        $processRegisterUrl = route('user.process-register-fingerprint', $userId);
        $getAcSnUrl = route('device.get-device-ac-sn-by-vc');
        echo "$userId;SecurityKey;" . $time_limit_reg . ";" . $processRegisterUrl . ";" . $getAcSnUrl;
    }

    public function processRegisterFingerprint($userId)
    {
        $result = $this->handleRegisterFingerprint($userId, request('RegTemp'));
        if ($result['verified']) {
            echo url('/usercardadmin') . '?message=registration success';
        } else {
            echo url('/usercardadmin') . '?message=' . $result['message'];
        }
    }

    public function verifyFingerprint($userId)
    {
        $user = UserCard::findOrFail($userId);
        $time_limit_ver = 15;
        echo "$userId;" . $user->fingerprints . ";SecurityKey;" . $time_limit_ver . ";" . route('user.process-verify-fingerprint') . ";" . route('device.get-device-ac-sn-by-vc') . ";extraParams";
    }

    public function processVerifyFingerprint()
    {
        $data = explode(";", $_POST['VerPas']);
        $userId = $data[0];
        $vStamp = $data[1];
        $time = $data[2];
        $sn = $data[3];

        $user = UserCard::findOrFail($userId);
        // jadi API

        $device = Device::query()
            ->where('sn', $sn)
            ->first();

        $salt = md5($sn . $user->fingerprints . $device->vc . $time . $userId . $device->vkey);
        if (strtoupper($vStamp) == strtoupper($salt)) {


            echo url('/usercardadmin') . '?message=login success';
        } else {

            echo url('/usercardadmin') . '?message=login failed';
        }
    }

    public function handleRegisterFingerprint($userId, $serializedData)
    {
        $result = array(
            'verified' => false,
            'user' => null,
            'message' => '',
        );


        $result['user'] = UserCard::find($userId);

        if ($result['user'] == null) {
            $result['message'] = 'User not found';
            Log::debug($result);
            return $result;
        }

        $data = $this->decodeRegistrationData($serializedData);
        Log::debug($data);
        if (empty($data)) {
            $result['message'] = 'Error decoding fingerprint data';
            Log::debug($result);
            return $result;
        }

        if ($this->isValidFingerprintRegistration($result['user'], $data)) {
            $result['user']->fingerprints = $data['regTemp'];
            if ($result['user']->save()) {
                $result['verified'] = true;
                $result['message'] = 'Fingerprints template successfully registered';
                Log::debug($result);
                return $result;
            } else {
                $result['message'] = 'Error saving fingerprint';
                Log::debug($result);
                return $result;
            }
        } else {
            $result['message'] = 'Data is not valid';
            Log::debug($result);
            return $result;
        }

        return $result;
    }

    private function decodeRegistrationData($serializedData)
    {
        @list($vStamp, $sn, $user_id, $regTemp) = explode(";", $serializedData);
        if (!isset($vStamp) || !isset($sn) || !isset($user_id) || !isset($regTemp)) {
            return array();
        }

        return array(
            'vStamp' => $vStamp,
            'sn' => $sn,
            'user_id' => $user_id,
            'regTemp' => $regTemp,
        );
    }

    public function isValidFingerprintRegistration($user, $data)
    {
        if ($user->id !== intval($data['user_id'])) {
            return false;
        }

        $device = Device::query()
            ->where('sn', $data['sn'])
            ->first();

        $salt = md5($device['ac'] . $device['vkey'] . $data['regTemp'] . $data['sn'] . $data['user_id']);
        return strtoupper($data['vStamp']) == strtoupper($salt);
    }

    public function getDeviceAcSnByVc()
    {
        $device = Device::query()
            ->where('vc', request('vc'))
            ->firstOrFail();
        return $device->ac . $device->sn;
    }
}
