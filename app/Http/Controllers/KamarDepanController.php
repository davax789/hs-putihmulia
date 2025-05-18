<?php

namespace App\Http\Controllers;

use App\Models\KamarDalam;
use App\Models\KamarDepan;
use Illuminate\Http\Request;

class KamarDepanController extends Controller
{
public function index() {
    $kamars = KamarDepan::all();
    return view('admin.admin-kamarDepan', compact('kamars'));
}

  public function create() {
    $kamar = KamarDepan::all();
    return view('admin.admin-kamarDepan', compact('kamar'));
}

    public function store(Request $request)
{
    $request->validate([
        'jenisKamar' => 'required|exists:kamar_depan,id',
        'nomorKamar' => 'required|string',
        'deskripsi' => 'required|string',
        'status' => 'nullable|string',
        'hargaPermalam' => 'required|integer',
        'photoKamar.*' => 'image|max:2048', // validasi untuk setiap file
    ]);

    $photoPaths = [];

    if ($request->hasFile('photoKamar')) {
        foreach ($request->file('photoKamar') as $file) {
            $photoPaths[] = $file->store('kamar', 'public');
        }
    }

    // Simpan paths sebagai JSON (atau simpan satu-satu di tabel lain jika perlu)
    KamarDalam::create([
        'jenisKamar' => $request->jenisKamar,
        'nomorKamar' => $request->nomorKamar,
        'deskripsi' => $request->deskripsi,
        'status' => $request->status ?? 'tersedia',
        'hargaPermalam' => $request->hargaPermalam,
        'photoKamar' => json_encode($photoPaths), // simpan sebagai array JSON
    ]);

    return redirect()->back()->with('success', 'Kamar dalam berhasil ditambahkan.');
}


    public function update(Request $request, $id) {
        $kamar = KamarDepan::findOrFail($id);

        $data = $request->validate([
            'jenisKamar' => 'required',
            'hargaPermalam' => 'required|integer',
            'deskripsi' => 'required',
        ]);

        if ($request->hasFile('photoKamar')) {
            $data['photoKamar'] = $request->file('photoKamar')->store('kamars', 'public');
        }

        $kamar->update($data);

        return redirect()->route('kamar.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id) {
        $kamar = KamarDepan::findOrFail($id);
        $kamar->delete();

        return redirect()->route('kamar.index')->with('success', 'Data berhasil dihapus.');
    }

}

