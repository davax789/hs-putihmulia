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
                $kamars = KamarDalam::all();
                $kamar = KamarDepan::pluck('jenisKamar');

        return view('admin.admin-kamarDalam', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kamarDepan = KamarDepan::all();
        $kamarDalam = KamarDalam::all();
    return view('admin.admin-kamarDalam', compact('kamarDepan', 'kamarDalam'));
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
        'photo_utama' => 'required|image|max:2048', // Satu file, bukan array
    ]);

    // Proses upload foto
    $photoPath = null;
    if ($request->hasFile('photo_utama')) {
        $pathUtama = $request->file('photo_utama')->store('kamar_dalam', 'public');
    }

    // Buat record kamarDalam, simpan path foto ke kolom photoKamar
    $kamar = KamarDalam::create([
        'jenisKamar'    => $request->jenisKamar,
        'nomorKamar'    => $request->nomorKamar,
        'deskripsi'     => $request->deskripsi,
        'status'        => $request->status ?? 'tersedia',
        'hargaPermalam' => $request->hargaPermalam,
        'photo_utama'    => $pathUtama,
    ]);

    return redirect()->back()->with('success', 'Kamar dalam berhasil ditambahkan.');
}

public function kamarDalam($jenisKamar)
{
    $kamars = KamarDalam::where('jenisKamar', $jenisKamar)
                ->get();

    return view('user.detail-kamar', compact('kamars', 'jenisKamar'));
}

    public function detailKamar()
    {
        $kamars = KamarDalam::all();
        return view('user.detail-kamar', compact('kamars'));
    }

    public function editKamar(Request $request)
    {
        $kamar = KamarDalam::where('nomorKamar', $request->nomorKamar)->firstOrFail();
        $validated = $request->validate([
        'nomorKamar'   => ['required', 'string', 'max:255'],
        'jenisKamar'    => ['required', 'string'],
        'deskripsi'    => ['required', 'string'],
        'hargaPermalam'=> ['required', 'integer'],
]);
        $kamar->nomorKamar = $validated['nomorKamar'];
        $kamar->jenisKamar = $validated['jenisKamar'];
        $kamar->deskripsi = $validated['deskripsi'];
        $kamar->hargaPermalam = $validated['hargaPermalam'];
        $kamar->save();

        return back()->with('success', 'Kamar berhasil diperbarui.');
    }
public function addPhoto(Request $request, $nomorKamar)
{
    $request->validate([
        'photoKamar' => 'required',
        'photoKamar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $kamar = KamarDalam::where('nomorKamar', $nomorKamar)->firstOrFail();

    if ($request->hasFile('photoKamar')) {
        foreach ($request->file('photoKamar') as $file) {
            $path = $file->store('rooms', 'public');

            PhotoKamar::create([
                'kamar_id' => $kamar->id,
                'photo_path' => $path,
            ]);
        }
    }

    return back()->with('success', 'Foto kamar berhasil diupload.');
}
}
