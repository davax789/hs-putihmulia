<?php

namespace App\Http\Controllers;

use App\Models\KamarDalam;
use Illuminate\Http\Request;

class BookingKamarController extends Controller
{
        public function bookingKamar($nomorKamar)
{
    $kamars = KamarDalam::where('nomorKamar', $nomorKamar)
                ->get();

    return view('user.booking-kamar', compact('kamars', 'nomorKamar'));
}
}
