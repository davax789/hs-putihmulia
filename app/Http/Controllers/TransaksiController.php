<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\KamarDalam;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Menampilkan halaman booking (form pemilihan tanggal).
     */
    public function create()
    {
        // Asumsi ada view booking.blade.php untuk halaman booking
        $kamars = Kamar::all();
        return view('booking', compact('kamars'));
    }

    /**
     * Menampilkan halaman detail transaksi.
     */
    public function show($kamarId, Request $request)
    {
        // Validasi input
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        // Ambil data kamar
        $kamar = KamarDalam::findOrFail($kamarId);

        // Hitung selisih hari
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');
        $checkInDate = Carbon::parse($check_in);
        $checkOutDate = Carbon::parse($check_out);

$diffDays = $checkInDate->diffInDays($checkOutDate);
$hargaPermalam = abs($kamar->hargaPermalam); // pastikan positif
$total_harga = $diffDays * $hargaPermalam;



        return view('user.user-transaksi', compact('kamar', 'check_in', 'check_out', 'total_harga'));

}
    /**
     */
    public function confirm(Request $request)
    {
        // Validasi input dari form konfirmasi
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'jumlah_kamar' => 'required|integer|min:1',
            'jumlah_tamu' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
        ]);

        // Simpan transaksi ke database
        $transaksi = new Transaksi();
        $transaksi->kamar_id = $request->kamar_id;
        $transaksi->check_in = $request->check_in;
        $transaksi->check_out = $request->check_out;
        $transaksi->jumlah_kamar = $request->jumlah_kamar;
        $transaksi->jumlah_tamu = $request->jumlah_tamu;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->save();

        // Redirect dengan pesan sukses
        return redirect()->route('transaksi.create')->with('success', 'Pemesanan berhasil dikonfirmasi!');
    }
}
?>
