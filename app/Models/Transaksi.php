<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'id_user_pembeli',
        'biaya_admin',
        'tgl_transaksi',
        'status_transaksi',
        'total_harga',
        'ongkir',
        'id_user_merchant'
    ];
}
