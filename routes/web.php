<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingKamarController;
use App\Http\Controllers\KamarDalamController;
use App\Http\Controllers\KamarDepanController;
use App\Http\Controllers\MyBookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\User;
use App\Models\MyBooking;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', [WelcomeController::class, 'index'])
    ->middleware(RedirectIfAuthenticated::class)
    ->name('welcome');

// Rute untuk login dan register
Route::get('/login', fn () => abort(404));
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'store'])->name('register');


Route::middleware([User::class])->group(function () {
    Route::get('/home', [WelcomeController::class, 'home'])->name('home');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateName'])->name('profile.update');
    Route::get('/my-booking', [MyBookingController::class, 'index'])->name('myBookings');
    Route::get('/order/success/{transaksi}', [MyBookingController::class, 'orderSuccess'])->name('order.success');
    Route::post( '/transaksi/{kamarId}', [TransaksiController::class, 'show'])->name('transaksi');
    Route::post('/pembayaran', [PaymentController::class, 'checkout'])->name('pembayaran');
    Route::post('/pembayaran/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');

});


Route::middleware([Admin::class])->group(function (): void {
Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin-order', [AdminController::class, 'orders'])->name('admin.order');
Route::post('/admin-orders/{id}/accept', [AdminController::class, 'accept'])->name('orders.accept');
Route::get('/admin-kamardepan', [KamarDepanController::class, 'index'])->name('admin.kamardepan');
Route::post('/admin-kamardepan', [KamarDepanController::class, 'store'])->name('admin.kamardepanStore');
Route::put('/admin-kamardepan/update/{id}', [KamarDepanController::class, 'update'])->name('admin.kamardepan.update');
Route::delete('/admin-kamardepan/delete/{id}', [KamarDepanController::class, 'destroy'])->name('admin.kamardepan.destroy');
Route::get('/admin-kamardalam', [KamarDalamController::class, 'index'])->name('admin.kamardalam');
Route::post('/admin-kamardalam/simpanKamar', [KamarDalamController::class, 'store'])->name('admin.kamardalamStore');
Route::post('/admin-kamardalam/addPhoto/{nomorKamar}', [KamarDalamController::class, 'addPhoto'])->name('admin.addPhoto');
Route::put('/admin-kamardalam/update/{id}', [KamarDalamController::class, 'update'])->name('admin.kamardalam.update');
Route::delete('/admin-kamardalam/delete/{id}', [KamarDalamController::class, 'destroy'])->name('admin.kamardalam.destroy');
Route::get('/laporan.transaksi', [AdminController::class, 'laporan'])->name('laporan.transaksi');

Route::get('/admin-booking', fn () => view('admin.admin-booking'))->name('admin.booking');
});


Route::get('/detail-kamar/{jenisKamar}', [KamarDalamController::class, 'kamarDalam'])->name('detail.kamar');
Route::get('/booking/{nomorKamar}', [BookingKamarController::class, 'index'])->name('booking.kamar');

Route::get('/redirect/google-login', function () {
    if (Auth::check()) {
        return redirect()->route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'home');
    }
    session(['google_action' => 'login']);
    return Socialite::driver('google')
        ->with(['prompt' => 'select_account'])
        ->redirect();
})->name('google.login.redirect');


Route::get('/redirect/google-register', function () {
    if (Auth::check()) {
        return redirect()->route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'home');
    }
    session(['google_action' => 'register']);
    return Socialite::driver('google')->redirect();
})->name('google.register.redirect');

Route::get('/redirect-after-login', function () {
    if (!Auth::check()) {
        return redirect()->route('welcome');
    }

    return Auth::user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('home');
})->name('redirect.after.login');
Route::get('/callback/google', [SocialAuthController::class, 'handleGoogleCallback']);
