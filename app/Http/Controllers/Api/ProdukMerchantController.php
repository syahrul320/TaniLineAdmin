<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukMerchantController extends Controller
{
    public function show($id)
    {
        $produk = DB::table('produks')
            ->where('produks.id_user_merchant', '=', $id)
            ->select(['nama_produk', 'users.name', 'kategoris.nama_kategori', 'produks.id'])
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->orderByDesc('produks.id')
            ->paginate(30);
        return response()->json($produk);
    }

    public function detail($id)
    {
        $produk = DB::table('produks')
            ->where('produks.id', '=', $id)
            ->select(['nama_produk', 'users.name', 'kategoris.nama_kategori', 'produks.id'])
            ->join('users', 'produks.id_user_merchant', '=', 'users.id')
            ->join('kategoris', 'produks.id_kategori', '=', 'kategoris.id')
            ->first();
        return response()->json($produk);
    }

    public function showKategori()
    {
        $kategoris = DB::table('kategoris')->get();
        return response()->json($kategoris);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'id_user_merchant' => 'required',
            'harga' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('upload/produk'), $imageName);
        }

        $produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'id_kategori' => $request->id_kategori,
            'id_user_merchant' => $request->id_user_merchant,
            'harga' => $request->harga,
            'image' => $imageName
        ]);

        return response()->json($produk, 201);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        $imagePath = public_path('upload/produk/' . $produk->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $produk->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
