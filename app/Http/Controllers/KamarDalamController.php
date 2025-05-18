<?php

namespace App\Http\Controllers;

use App\Models\KamarDalam;
use App\Models\KamarDepan;
use App\Models\PhotoKamar;
use Illuminate\Http\Request;

class KamarDalamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                $kamars = KamarDepan::all();
        return view('admin.admin-kamarDalam', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kamars = KamarDepan::all();
    return view('admin.admin-kamarDalam', compact('kamars'));
    }

    /**
     * Store a newly created resource in storage.
     * Display the specified resource.
     */
    public function show(KamarDalam $kamarDalam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KamarDalam $kamarDalam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KamarDalam $kamarDalam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KamarDalam $kamarDalam)
    {
        //
    }

    public function store(Request $request)
{
    $request->validate([
    'jenisKamar' => 'required|exists:kamarDepan,jenisKamar',
    'nomorKamar' => 'required|string',
    'deskripsi' => 'required|string',
    'status' => 'nullable|string',
    'hargaPermalam' => 'required|integer',
    'photoKamar' => 'nullable|array',
    'photoKamar.*' => 'image|max:2048',
]);

    $kamar = KamarDalam::create([
    'jenisKamar' => $request->jenisKamar,
    'nomorKamar' => $request->nomorKamar,
    'deskripsi' => $request->deskripsi,
    'status' => $request->status ?? 'tersedia',
    'hargaPermalam' => $request->hargaPermalam,
]);

    if ($request->hasFile('photoKamar')) {
    foreach ($request->file('photoKamar') as $file) {
        $path = $file->store('kamars', 'public');

        PhotoKamar::create([
            'kamar_id' => $kamar->id,
            'photo_path' => $path,
        ]);
    }
}

return redirect()->back()->with('success', 'Kamar dalam berhasil ditambahkan.');

}

public function kamarDalam($jenisKamar)
{
    $kamars = KamarDalam::with('photoKamar')
                ->where('jenisKamar', $jenisKamar)
                ->get();

    return view('user.detail-kamar', compact('kamars', 'jenisKamar'));
}

    public function detailKamar()
    {
        $kamars = KamarDalam::all();
        return view('user.detail-kamar', compact('kamars'));
    }

    public function bookingKamar($nomorKamar)
{
    $kamars = KamarDalam::where('noKamar', $nomorKamar)
                ->get();

    return view('user.booking-kamar', compact('kamars', 'nomorKamar'));
}
}
