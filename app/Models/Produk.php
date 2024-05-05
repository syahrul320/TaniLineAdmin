<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'harga', 'nama_produk', 'id_kategori', 'id_user_merchant', 'image', 'deskripsi','stok'
    ];
}
