<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user_merchant',
        'title',
        'amount',
        'status',
        'external_id',
        'url'
    ];
}
