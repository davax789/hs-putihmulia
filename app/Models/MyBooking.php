<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyBooking extends Model
{
        use HasFactory;



public function kamar()
{
    return $this->belongsTo(KamarDalam::class, 'id'); // sesuaikan foreign key-nya
}

}
