<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\UserAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

// Route untuk pengguna yang sudah terautentikasi
Route::middleware(['auth'])->group(function () {
    // Halaman untuk pengguna biasa
    Route::get('/home', function () {
        return view('user.home-user');
    })->name('home');

    // Halaman untuk admin
    Route::middleware([UserAdmin::class])->group(function () {
        Route::get('/admin-dashboard', function () {
            return view('admin.admin-dashboard');
        })->name('admin.dashboard');

        // Profile route untuk pengguna yang login
        Route::get('/profile', fn() => view('user.profile'))->name('profile');
        Route::post('/profile/update', [AuthController::class, 'updateName'])->name('profile.update');
    });
});

// Route default (untuk non-login)
Route::get('/', function () {
    if (Auth::check()) {
        // Mengarahkan ke home atau admin dashboard berdasarkan role
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.dashboard')  // Admin diarahkan ke dashboard admin
            : redirect()->route('home');  // Pengguna biasa diarahkan ke halaman home
    }
    return view('welcome');  // Jika belum login, arahkan ke halaman welcome
})->name('welcome');

// Route login dan register
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/register', [AuthController::class, 'store'])->name('register');
/////////////////////////////////////////////


// Login lewat Google
Route::get('/redirect/google-login', function () {
    if (Auth::check()) {
        return redirect()->route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'home');
    }
    session(['google_action' => 'login']);
    return Socialite::driver('google')->redirect();
})->name('google.login.redirect');

// Daftar lewat Google
Route::get('/redirect/google-register', function () {
    if (Auth::check()) {
        return redirect()->route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'home');
    }
    session(['google_action' => 'register']);
    return Socialite::driver('google')->redirect();
})->name('google.register.redirect');

// Callback Google (dipakai keduanya)
Route::get('/callback/google', [AuthController::class, 'handleGoogleCallback']);
