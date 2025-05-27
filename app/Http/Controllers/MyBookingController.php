<?php

namespace App\Http\Controllers;

use App\Models\MyBooking;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MyBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index()
{

$myBookings = Transaksi::with('kamar')
    ->where('id_user', auth()->id())
    ->orderBy('created_at', 'desc')
    ->get();


    return view('user.mybooking', compact('myBookings'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MyBooking $myBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyBooking $myBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MyBooking $myBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyBooking $myBooking)
    {
        //
    }
public function orderSuccess($transaksi)
{
    $transaksi = Transaksi::where('kode_transaksi', $transaksi)->firstOrFail();

    $checkin = Carbon::parse($transaksi->check_in);
    $checkout = Carbon::parse($transaksi->check_out);
    $durasi = $checkin->diffInDays($checkout);

return view('user.order-succes', compact('transaksi', 'durasi'));
}


}
