<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KamarDalam;
use App\Models\Transaksi;
use Midtrans\Snap;
use Midtrans\Config;
use Carbon\Carbon;
use Auth;
use Midtrans\Notification;
use Exception;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller
{


public function checkout(Request $request)
{
    $request->validate([
        'kamar_id' => 'required|exists:kamarDalam,id',
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
    ]);

    $user = Auth::user();
    $kamar = KamarDalam::findOrFail($request->kamar_id);

    $diff = Carbon::parse($request->check_in)->diffInDays(Carbon::parse($request->check_out));
    $total_harga = $diff * $kamar->hargaPermalam;

    // Cek apakah sudah ada transaksi pending untuk user dan kamar ini
    $transaksi = Transaksi::where('id_user', $user->id)
        ->where('noKamar', $kamar->nomorKamar)
        ->where('status', 'pending')
        ->latest()
        ->first();

    if ($transaksi) {
        // Update checkin/checkout dan total harga jika berubah
        $transaksi->update([
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_harga' => $total_harga,
            'tanggal_transaksi' => now(),
        ]);
    } else {
        // Buat transaksi baru jika belum ada transaksi pending untuk kamar ini
        $kode_transaksi = time();
        $transaksi = Transaksi::create([
            'id_user' => $user->id,
            'noKamar' => $kamar->nomorKamar,
            'kode_transaksi' => $kode_transaksi,
            'total_harga' => $total_harga,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'metode_pembayaran' => 'midtrans',
            'status' => 'pending',
            'tanggal_transaksi' => now(),
            'snap_token' => null,
        ]);
    }

    // Midtrans setup
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = config('midtrans.is_sanitized');
    Config::$is3ds = config('midtrans.is_3ds');

    $params = [
        'transaction_details' => [
            'order_id' => $transaksi->kode_transaksi,
            'gross_amount' => $transaksi->total_harga,
        ],
        'customer_details' => [
            'first_name' => $user->name,
            'email' => $user->email,
        ],
        'callbacks' => [
            'notification' => route('notification'),
        ],
    ];

    try {
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaksi->update(['snap_token' => $snapToken]);
    } catch (\Exception $e) {
        \Log::error('Midtrans Snap Token Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Gagal membuat transaksi. Silakan coba lagi.');
    }

    return view('user.pembayaran', [
        'snapToken' => $snapToken,
        'kode_transaksi' => $transaksi->kode_transaksi
    ]);
}



public function notification(Request $request)
{
    Log::info('Midtrans Notification:', $request->all());

    $transactionStatus = $request->input('transaction_status');
    $orderId = $request->input('order_id');
    $paymentType = $request->input('payment_type'); // ambil metode pembayaran dari notifikasi

    $transaksi = Transaksi::where('kode_transaksi', $orderId)->first();

    if (!$transaksi) {
        Log::error('Transaksi tidak ditemukan untuk order_id: ' . $orderId);
        return response()->json(['status' => 'error'], 404);
    }

    switch ($transactionStatus) {
        case 'settlement':
        case 'capture':
            $transaksi->status = 'PAID';
            $transaksi->tanggal_pembayaran = now();
            break;
        case 'pending':
            $transaksi->status = 'PENDING';
            break;
        case 'deny':
        case 'cancel':
        case 'expire':
            $transaksi->status = 'FAILED';
            break;
    }

    $transaksi->metode_pembayaran = $paymentType;

    $transaksi->save();

    Log::info("Transaksi {$orderId} diupdate ke status {$transaksi->status} dan metode pembayaran {$paymentType}");

    return response()->json(['status' => 'success'], 200);
}


}
