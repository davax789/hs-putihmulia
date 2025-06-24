<?php

namespace App\Http\Controllers;

use App\Models\KamarDalam;
use App\Models\KamarDepan;
use App\Models\PhotoKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KamarDalamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $kamars = KamarDalam::all();
    $kamarDepan = KamarDepan::pluck('jenisKamar');
    $kamarDalam = KamarDalam::all();


    return view('admin.admin-kamardalam', compact('kamars', 'kamarDepan','kamarDalam'));
}

    /**
     * Show the form for creating a new resource.
     */

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

public function update(Request $request, $id)
    {
        $kamar = KamarDalam::findOrFail($id);

        $request->validate([
            'jenisKamar' => 'required|string|max:255',
            'nomorKamar' => 'required|string|max:255',
            'hargaPermalam' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'photo_path.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'photo_path' => 'nullable|max:4', // Maks 4 file
            'status' => 'required|in:tersedia,tidak Tersedia',
        ]);

        // Update data kamar
        $kamar->update([
            'jenisKamar' => $request->jenisKamar,
            'nomorKamar' => $request->nomorKamar,
            'hargaPermalam' => $request->hargaPermalam,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);

        // Handle upload foto
        if ($request->hasFile('photo_path')) {
            PhotoKamar::where('kamar_id', $kamar->id)->delete();
            Storage::disk('public')->delete($kamar->photo_utama);

            foreach ($request->file('photo_path') as $index => $file) {
                $path = $file->store('images/kamar', 'public');
                PhotoKamar::create([
                    'kamar_id' => $kamar->id,
                    'photo_path' => $path,
                ]);

                // Update photo_utama kalo ini foto pertama
                if ($index === 0) {
                    $kamar->update(['photo_path' => $path]);
                }
            }
        }

        return redirect()->route('admin.kamardalam')->with('success', 'Kamar berhasil diupdate');
    }




    public function destroy($id)
{
    $kamar = KamarDalam::findOrFail($id);
    $kamar->delete();

    return redirect()->back()->with('success', 'Kamar berhasil dihapus.');
}
}
