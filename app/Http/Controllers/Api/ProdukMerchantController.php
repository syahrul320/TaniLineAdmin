<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukMerchantController extends Controller
{
    public function show($id)
    {
        try {
            $produk = DB::table('produks')
                ->where('produks.id_user_merchant', '=', $id)
                ->select(['nama_produk', 'users.name', 'kategoris.nama_kategori', 'produks.*'])
                ->join('users', 'produks.id_user_merchant', '=', 'users.id')
                ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
                ->orderByDesc('produks.id')
                ->paginate(30);
            return response()->json($produk);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function detail($id)
    {
        try {
            $produk = DB::table('produks')
                ->where('produks.id', '=', $id)
                ->select(['nama_produk', 'users.name', 'kategoris.nama_kategori', 'produks.id'])
                ->join('users', 'produks.id_user_merchant', '=', 'users.id')
                ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
                ->first();
            return response()->json($produk);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function showKategori()
    {
        try {
            $kategoris = DB::table('kategoris')->get();
            return response()->json($kategoris);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_produk' => 'required',
                'id_kategori' => 'required',
                'id_user_merchant' => 'required',
                'harga' => 'required',
                'deskripsi' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('upload/produk'), $imageName);

            $produk = new Produk();
            $produk->nama_produk = $request->nama_produk;
            $produk->id_kategori = $request->id_kategori;
            $produk->id_user_merchant = $request->id_user_merchant;
            $produk->harga = $request->harga;
            $produk->deskripsi = $request->deskripsi;
            $produk->image = $imageName;
            $produk->stok = '0';
            $produk->save();

            return response()->json($produk, $status = 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function update(Request $request, $id)
    {
        // try {
            $validator = Validator::make($request->all(), [
                'nama_produk' => 'required',
                'id_kategori' => 'required',
                'id_user_merchant' => 'required',
                'harga' => 'required',
                'stok' => 'required',
                'deskripsi' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $produk = Produk::findOrFail($id);

            if ($request->hasFile('image')) {
                $imagePath = public_path('upload/produk/' . $produk->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('upload/produk'), $imageName);
                $produk->image = $imageName;

                $produk->update([
                    'nama_produk' => $request->nama_produk,
                    'id_kategori' => $request->id_kategori,
                    'id_user_merchant' => $request->id_user_merchant,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                    'image' => $imageName,
                    'stok' => $request->stok,
                ]);
            }else if (!$request->hasFile('image')) {
                $produk->update([
                    'nama_produk' => $request->nama_produk,
                    'id_kategori' => $request->id_kategori,
                    'id_user_merchant' => $request->id_user_merchant,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                    'stok' => $request->stok,
                ]);
            }

            return response()->json($produk,['success' => TRUE]);
        // } catch (\Throwable $th) {
        //     return response()->json(['error' => $th->getMessage()], 401);
        // }
    }

    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);

            $imagePath = public_path('upload/produk/' . $produk->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $produk->delete();

            return response()->json(['message' => 'Product deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
