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
        'id_produk',
        'qty',
        'harga',
        'biaya_admin',
        'total_biaya',
        'tgl_transaksi',
        'status_transaksi',
    ];
}
