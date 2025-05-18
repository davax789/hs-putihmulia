<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarDepan extends Model
{
        use HasFactory;

    protected $table = 'kamarDepan';

    protected $fillable = [
        'jenisKamar',
        'hargaPermalam',
        'deskripsi',
        'photoKamar'
    ];
}
