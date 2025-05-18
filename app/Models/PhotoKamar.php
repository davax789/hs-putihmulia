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

public function kamar()
{
    return $this->belongsTo(KamarDalam::class, 'kamar_id');
}

}
