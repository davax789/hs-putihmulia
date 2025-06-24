<?php

namespace App\Http\Controllers;

use App\Models\KamarDalam;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search');

    $kamarTersedia = KamarDalam::where('status', 'tersedia')->count();
    $totalOrder = Transaksi::count();
    $dashboard = Transaksi::with('user')
        ->when($search, function ($query, $search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        })
        ->get();

    return view('admin.admin-dashboard', compact('dashboard','kamarTersedia','totalOrder'));
}

public function orders()
{
    $orders = Transaksi::with(['user', 'admin', 'kamar'])
                ->where('status', 'success')
                ->latest()
                ->get();

    return view('admin.admin-order', compact('orders'));
}


public function accept($id)
{
$order = Transaksi::findOrFail($id);
$order->acceptedby = Auth::id();
$order->save();

    return redirect()->back()->with('success', 'Order berhasil diterima.');
}


public function laporan(Request $request)
{
    $transactions = Transaksi::query();

    if ($request->filled('daterange')) {
        [$start, $end] = explode(' - ', $request->input('daterange'));

        try {
            $startDate = \Carbon\Carbon::createFromFormat('d-m-Y', trim($start))->startOfDay();
            $endDate = \Carbon\Carbon::createFromFormat('d-m-Y', trim($end))->endOfDay();

            $transactions->whereBetween('created_at', [$startDate, $endDate]);
        } catch (\Exception $e) {
        }
    } elseif ($request->filled('filter')) {
        $days = (int) $request->input('filter', 7);
        $transactions->where('created_at', '>=', now()->subDays($days));
    }

    $transactions = $transactions->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.laporan-transaksi', compact('transactions'));
}


}
