<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search');

    $dashboard = Transaksi::with('user')
        ->when($search, function ($query, $search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        })
        ->get();

    return view('admin.admin-dashboard', compact('dashboard'));
}

public function orders()
{
    $orders = Transaksi::with(['user', 'admin', 'kamar'])->latest()->get();
    return view('admin.admin-order', compact('orders'));
}

public function accept($id)
{
$order = Transaksi::findOrFail($id);
$order->acceptedby = Auth::id(); // Simpan ID user yang sedang login
$order->save();

    return redirect()->back()->with('success', 'Order berhasil diterima.');
}

}
