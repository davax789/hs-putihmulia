<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class KamarDalam extends Model
{
        use HasFactory;

    protected $table = 'kamarDalam';

    protected $fillable = [
        'jenisKamar',
        'nomorKamar',
        'deskripsi',
        'status',
        'hargaPermalam',
    ];
    public function photoKamar()
{
    return $this->hasMany(PhotoKamar::class, 'kamar_id');
}

}

