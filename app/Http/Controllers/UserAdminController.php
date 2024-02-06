<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('level', '=', 'admin')->get();
            return DataTables::of($data)->addColumn('actions', function ($row) {
                $button = '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" onclick= edit("' . encrypt($row->id) . '") data-original-title="Edit"><span class="badge bg-success"> Edit</span></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" onclick= destroy("' . encrypt($row->id) . '") ><span class="badge bg-warning"> Delete</span></a>';
            
                return $button;
            })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('useradmin.index');
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'number_telephone' => 'required|numeric',
            'password' => 'required|min:6',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'number_telephone' => $request->number_telephone,
                'password' => Hash::make($request->password),
                'alamat' => $request->alamat,
                'level' => 'admin',
                'username' => $request->name,
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
            // 'email' => 'email|max:255|unique:users',
            'number_telephone' => 'required|numeric',
            'alamat' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            if ($request->password == "") {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'number_telephone' => $request->number_telephone,
                    'alamat' => $request->alamat,
                ]);
            }else{
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'number_telephone' => $request->number_telephone,
                    'password' => Hash::make($request->password),
                    'alamat' => $request->alamat,
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
