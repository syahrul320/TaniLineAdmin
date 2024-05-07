<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangBelanja extends Model
{
    use HasFactory;
    protected  $fillable = [
        'id', 'id_produk', 'id_user', 'jumlah', 'total_harga', 'harga', 'keterangan', 'id_user_merchant'
    ];
}
