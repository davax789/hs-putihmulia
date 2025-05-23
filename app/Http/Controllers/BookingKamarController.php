<?php

namespace App\Http\Controllers;

use App\Models\KamarDalam;
use Illuminate\Http\Request;

class BookingKamarController extends Controller
{
public function index($nomorKamar)
{
    session(['nomorKamar' => $nomorKamar]);

    $kamars = KamarDalam::with('photoKamar')
                ->where('nomorKamar', $nomorKamar)
                ->get();

    return view('user.booking-kamar', compact('kamars', 'nomorKamar'));
}


}
