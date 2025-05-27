<?php

namespace App\Http\Controllers;

use App\Models\KamarDalam;
use App\Models\KamarDepan;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
public function index()
{
    $kamars = KamarDepan::all();

    return response()
        ->view('welcome', compact('kamars'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
}

            public function home()
    {
        $kamars = KamarDepan::all();
        return view('user.home-user', compact('kamars'));
    }


}
