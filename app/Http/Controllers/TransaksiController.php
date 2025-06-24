<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\KamarDalam;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{

    public function create()
    {
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
}
?>
