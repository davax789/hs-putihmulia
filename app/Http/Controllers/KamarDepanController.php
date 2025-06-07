<?php

namespace App\Http\Controllers;

use App\Models\KamarDalam;
use App\Models\KamarDepan;
use Illuminate\Http\Request;

class KamarDepanController extends Controller
{
public function index() {
    $kamars = KamarDepan::all();
    return view('admin.admin-kamardepan', compact('kamars'));
}

  public function create() {
    $kamar = KamarDepan::all();
    return view('admin.admin-kamardepan', compact('kamar'));
}

public function store(Request $request)
{
    $request->validate([
        'jenisKamar' => 'required|string',
        'deskripsi' => 'required|string',
        'hargaPermalam' => 'required|integer',
        'photoKamar' => 'required|image|max:2048',
    ]);

    $photoPath = null;

    if ($request->hasFile('photoKamar')) {
        $photoPath = $request->file('photoKamar')->store('kamar', 'public');
    }

    KamarDepan::create([
        'jenisKamar' => $request->jenisKamar,
        'deskripsi' => $request->deskripsi,
        'hargaPermalam' => $request->hargaPermalam,
        'photoKamar' => $photoPath
    ]);

    return redirect()->back()->with('success', 'Kamar berhasil ditambahkan.');
}


//     public function kamarDepan($jenisKamar)
// {
//     $kamars = KamarDepan::where('jenisKamar', $jenisKamar)
//                 ->get();

//     return view('user.detail-kamar', compact('kamars', 'jenisKamar'));
// }

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


        return redirect()->route('admin.kamardepan')->with('success', 'Data berhasil diperbarui.');

    }

    public function destroy($id) {
        $kamar = KamarDepan::findOrFail($id);
        $kamar->delete();


        return redirect()->route('admin.kamardepan')->with('success', 'Data berhasil dihapus.');

    }

}

