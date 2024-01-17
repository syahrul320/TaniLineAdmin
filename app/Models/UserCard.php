<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_usercard',
        // 'nis_nip',
        'jk',
        'id_lembaga',
        'id_kelas',
        'alamat',
        'id_perusahaan',
        'id_kategori_user',
        'id_user',
        'barcode',
        'limit_harian',
        'total_belanja_sekarang',
        'tanggal_sekarang',
        'status_user',
    ];
}
