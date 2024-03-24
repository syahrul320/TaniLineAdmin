<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user_merchant',
        'id_produk',
        'id_transaksi',
        'harga_jual',
        'qty'
    ];
}
