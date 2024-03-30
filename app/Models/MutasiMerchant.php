<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiMerchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user_merchant',
        'debet',
        'kredit',
        'keterangan',
    ];
}
