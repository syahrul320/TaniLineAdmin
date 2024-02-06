<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class InformasiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Informasi::all();
            return DataTables::of($data)->addColumn('actions', function ($row) {
                $button = '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" onclick= edit("' . encrypt($row->id) . '") data-original-title="Edit"><span class="badge bg-success"> Edit</span></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" onclick= destroy("' . encrypt($row->id) . '") ><span class="badge bg-warning"> Delete</span></a>';

                return $button;
            })
                ->addColumn('image', function ($row) {
                    return '<img width=60 height=60 class=img-thumbnail src=' .
                        asset("upload/informasi/$row->image") .'>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['actions','image'])
                ->make(true);
        }
        return view('informasi.index');
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'informasi'         => 'required',
            'image'             => 'required|image|mimes:png,jpg,jpeg',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('upload/informasi'), $imageName);
            $informasi = informasi::create([
                'informasi'         => $request->informasi,
                'image'             => $imageName,
            ]);
            return response()->json(['success' => TRUE]);
        }
    }

    public function edit(Request $request)
    {
        $informasi = Informasi::findOrFail(decrypt($request->id));
        return response()->json(['data' => $informasi]);
    }

    public function update(Request $request)
    {
        $informasi = Informasi::findOrFail($request->id);
        $validator = Validator::make($request->all(), [
            'informasi'         => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            if ($request->hasFile('image')) {
                if ($informasi->image) {
                    unlink('upload/informasi/' . $informasi->image);
                }
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('upload/informasi'), $imageName);
                $informasi->update([
                    'informasi'         => $request->informasi,
                    'image'             => $imageName,
                ]);
            }else if (!$request->hasFile('image')) {
                $informasi->update([
                    'informasi'         => $request->informasi,
                ]);
            }
        }
        return response()->json(['success' => TRUE]);
    }

    public function destroy(Request $request)
    {
        $informasi = Informasi::findOrFail(decrypt($request->id));
        unlink('upload/informasi/' . $informasi->image);
        $informasi->delete();
        return response()->json(['success' => 'Informasi deleted successfully.']);
    }
}
