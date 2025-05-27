<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;

Route::post('/midtrans/notification', [PaymentController::class, 'notification'])->name('notification');
