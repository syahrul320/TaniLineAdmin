<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->id_perusahaan;
        $perusahaan = Perusahaan::findOrFail($user);
        if ($request->ajax()) {
            $data = User::where('id_perusahaan', $user)
                ->where('level', '!=', '7')
                ->where('level', '!=', '3')->latest()->get();

            return DataTables::of($data)->addColumn('actions', function ($row) {
                $button = '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" onclick= edit("' . encrypt($row->id) . '") data-original-title="Edit"><span class="badge bg-success"> Edit</span></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" onclick= destroy("' . encrypt($row->id) . '") ><span class="badge bg-warning"> Delete</span></a>';
                return $button;
            })->addColumn('level_admins', function ($row) {
                $level = '';
                if($row->level == 2){
                    $level .= '<span class="badge bg-primary"> Admin Perusahaan</span></a>';
                }
                if($row->level == 4){
                    $level .= '<span class="badge bg-primary"> Customer Service</span></a>';
                }
                if($row->level == 5){
                    $level .= '<span class="badge bg-primary"> Teller</span></a>';
                }
                if($row->level == 8){
                    $level .= '<span class="badge bg-primary"> Informasi</span></a>';
                }
                if($row->level == 10){
                    $level .= '<span class="badge bg-primary"> Kesehatan</span></a>';
                }
                return $level;
            })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['actions', 'level_admins'])
                ->make(true);
        }
        return view('user_admin.index', ['perusahaan' => $perusahaan]);
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'number_telephone' => 'required',
            'username' => 'required',
            'level' => 'required',
            'nis_nip' => 'required',
            'id_perusahaan' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'number_telephone' => $request->number_telephone,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'nis_nip' => $request->nis_nip,
                'id_perusahaan' => $request->id_perusahaan,
                'level' => $request->level,
            ]);
            return response()->json(['success' => TRUE]);
        }
    }

    public function edit(Request $request)
    {
        $user = User::findOrFail(decrypt($request->id));
        return response()->json(['data' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'number_telephone' => 'required',
            'username' => 'required',
            'level' => 'required',
            'nis_nip' => 'required',
            'id_perusahaan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            if ($request->password == "") {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'number_telephone' => $request->number_telephone,
                    'username' => $request->username,
                    'level' => $request->level,
                    'nis_nip' => $request->nis_nip,
                ]);
            }else{
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'number_telephone' => $request->number_telephone,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'level' => $request->level,
                    'nis_nip' => $request->nis_nip,
                ]);
            }
        }
        return response()->json(['success' => TRUE]);
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail(decrypt($request->id));
        $user->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }
}
