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
        return view('welcome', compact('kamars'));
    }
            public function home()
    {
        $kamars = KamarDepan::all();
        return view('user.home-user', compact('kamars'));
    }


}
