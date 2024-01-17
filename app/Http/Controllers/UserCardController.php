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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserCardController extends Controller
{
    // public function __construct()
    // {
    //     var $time_limit_reg = "15";
    //     var $time_limit_ver = "10";
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Perusahaan::all();
            return DataTables::of($data)->addColumn('actions', function ($row) {
                $button = '<a href="usercard/user/' . encrypt($row->id) . '"><ion-icon name="newspaper-sharp"></ion-icon></a>';
                return $button;
            })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('user_card.index');
    }

    public function export()
    {
        return Excel::download(new UserCardExport, 'User.xlsx');
    }

    public function user(Request $request, $id)
    {
        $perusahaan = Perusahaan::findOrFail(decrypt($request->id));
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
                ->where('id_perusahaan', decrypt($id));
            return DataTables::of($data)->addColumn('actions', function ($row) {
                $button = '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" onclick= edit("' . encrypt($row->id) . '") data-original-title="Edit"><span class="badge bg-success"> Edit</span></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" onclick= destroy("' . encrypt($row->id) . '") ><span class="badge bg-warning"> Delete</span></a>';
                if ($row->fingerprints == null) {
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="finspot:FingerspotReg;' . base64_encode(route('user.register-fingerprint', $row->id)) . '"><span class="badge bg-success">Register</span></a>';
                } else {
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="finspot:FingerspotVer;' . base64_encode(route('user.verify-fingerprint', $row->id)) . '"><span class="badge bg-primary">Login</span></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="finspot:FingerspotReg;' . base64_encode(route('user.register-fingerprint', $row->id)) . '"><span class="badge bg-success">Register ulang</span></a>';
                }
                if ($row->va == null) {
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="javascript:void(0)" onclick= create_va("' . $row->id . '") ><span class="badge bg-info"> Create VA</span></a>';
                }
                return $button;
            })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['actions', 'code'])
                ->make(true);
        }
        return view('user_card.list', ['lembaga' => $lembaga, 'user' => $user, 'perusahaan' => $perusahaan, 'katergori_user' => $katergori_user, 'rekening_poling' => $rekening_poling]);
    }

    public function getlembaga(Request $request)
    {
        $kelas = Kelas::where('id_lembaga', $request->id_lembaga)
            ->get(['id', 'kelas']);
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
        $rekening_poling = RekPoling::join('banks', 'rek_polings.id_perusahaan', 'banks.id')->get()->first();
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
            $user->update([
                'name' => $request->nama_usercard,
                'email' => $request->email,
                'number_telephone' => $request->nohp,
                'username' => $request->username,
                'nis_nip' => $request->nis_nip,
            ]);
            $usercard->update([
                'nama_usercard' => $request->nama_usercard,
                'jk' => $request->jk,
                'id_lembaga' => $request->id_lembaga,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'id_kategori_user' => $request->id_kategori_user,
                'limit_harian' => $request->limit_harian,
                'status_user' => $request->status_user,
            ]);
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
            $data         = explode(";", $_POST['RegTemp']);
            $vStamp     = $data[0];
            $sn         = $data[1];
            $user_card_id    = $data[2];
            $regTemp     = $data[3];

            $device = $this->getDeviceBySn($sn);

            $salt = md5($device[0]['ac'] . $device[0]['vkey'] . $regTemp . $sn . $user_card_id);

            if (strtoupper($vStamp) == strtoupper($salt)) {

                $sql1         = Finger::select(DB::raw("MAX(*) as fid"))
                    ->where('user_card_id', '=', '$user_card_id')->first();
                $fid         = $sql1->fid;

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
                'device_name'    => $row->device_name,
                'sn'        => $row->sn,
                'vc'        => $row->vc,
                'ac'        => $row->ac,
                'vkey'        => $row->vkey
            );

            $i++;
        }
        echo $arr[0]['ac'] . $arr[0]['sn'];
    }

    function getDeviceBySn($sn)
    {
        $sql     = Device::get();
        $arr     = array();
        $i     = 0;

        foreach ($sql as $row) {
            $arr[$i] = array(
                'device_name'    => $row->device_name,
                'sn'        => $row->sn,
                'vc'        => $row->vc,
                'ac'        => $row->ac,
                'vkey'        => $row->vkey
            );
            $i++;
        }

        return $arr;
    }
}
