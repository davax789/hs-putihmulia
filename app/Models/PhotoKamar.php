<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoKamar extends Model
{
    protected $table = 'fotokamar';

    protected $fillable = [
        'kamar_id',
        'photo_path',
    ];

}

class Kamar extends Model
{
    public function kamarDalam()
    {
        return $this->belongsTo(KamarDalam::class, 'kamar_id');
    }
}
