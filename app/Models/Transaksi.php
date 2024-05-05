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
<<<<<<< HEAD
        'total',
=======
        'total_harga',
>>>>>>> b5c64736c17a051694b552b13895f6e5d26edbdf
        'ongkir'
    ];
}
