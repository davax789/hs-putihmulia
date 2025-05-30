<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KamarDalam;
use App\Models\Transaksi;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;

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



    /**
     * Handle Midtrans notification callback
     */
public function notification(Request $request)
{
    $serverKey = config('midtrans.server_key');
    $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

    if ($hashed == $request->signature_key) {
        $transaksi = Transaksi::where('kode_transaksi', $request->order_id)->first();

        if ($transaksi) {
            $kamar = KamarDalam::where('nomorKamar', $transaksi->noKamar)->first();

            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $transaksi->update([
                    'status' => 'success',
                    'tanggal_pembayaran' => now(),
                ]);

                if ($kamar) {
                    $kamar->update(['status' => 'tidak tersedia']);
                }

            } elseif ($request->transaction_status == 'pending') {
                $transaksi->update(['status' => 'pending']);

            } elseif (in_array($request->transaction_status, ['deny', 'expire', 'cancel'])) {
                $transaksi->update(['status' => 'failed']);

                if ($kamar) {
                    $kamar->update(['status' => 'tersedia']);
                }
            }
        }
    }

    return response('OK', 200);
}


}
