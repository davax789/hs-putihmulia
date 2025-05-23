<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'id_user',
        'noKamar',
        'kode_transaksi',
        'total_harga',
        'check_in',
        'check_out',
        'metode_pembayaran',
        'status',
        'tanggal_transaksi',
        'tanggal_pembayaran',
    ];

    /**
     * Relasi ke user (pemesan)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke kamar
     */
    public function kamar()
    {
        return $this->belongsTo(KamarDalam::class, 'noKamar', 'nomorKamar');
    }
}
