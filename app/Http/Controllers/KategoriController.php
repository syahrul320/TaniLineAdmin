<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kategori::all();
            return DataTables::of($data)->addColumn('actions', function ($row) {
                $button = '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" onclick= edit("' . encrypt($row->id) . '") data-original-title="Edit"><span class="badge bg-success"> Edit</span></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0)" onclick= destroy("' . encrypt($row->id) . '") ><span class="badge bg-warning"> Delete</span></a>';

                return $button;
            })
                ->addColumn('image', function ($row) {
                    return '<img width=60 height=60 class=img-thumbnail src=' .
                        asset("upload/kategori/$row->image") . '>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['actions', 'image'])
                ->make(true);
        }
        return view('kategori.index');
    }

    public function insert_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('upload/kategori'), $imageName);
            $kategori = Kategori::create([
                'nama_kategori' => $request->nama_kategori,
                'image' => $imageName,
            ]);
            return response()->json(['success' => TRUE]);
        }
    }

    public function edit(Request $request)
    {
        $kategori = Kategori::findOrFail(decrypt($request->id));
        return response()->json(['data' => $kategori]);
    }

    public function update(Request $request)
    {
        $kategori = Kategori::findOrFail($request->id);
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
            ]);
        }
        return response()->json(['success' => TRUE]);
    }

    public function destroy(Request $request)
    {
        $kategori = Kategori::findOrFail(decrypt($request->id));
        $kategori->delete();
        return response()->json(['success' => 'Kategori deleted successfully.']);
    }
}
