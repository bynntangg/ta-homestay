<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use App\Models\Homestay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TipeKamarController extends Controller
{
    // Menampilkan daftar tipe kamar (Mode Index)
    public function index()
    {
        // Ambil semua tipe kamar beserta relasi homestay
        $tipeKamars = TipeKamar::with('homestay')->get();

        return view('pemilik.tipe_kamar.index', [
            'mode' => 'index',
            'tipeKamars' => $tipeKamars,
        ]);
    }

    // Menampilkan form tambah tipe kamar (Mode Create)
    public function create()
    {
        // Ambil semua homestay dari database
        $homestays = Homestay::all();

        return view('pemilik.tipe_kamar.index', [
            'mode' => 'create',
            'homestays' => $homestays, // Kirim semua homestay ke view
        ]);
    }
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'homestay_id' => 'required|exists:homestays,id',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Simpan data ke database
        $tipeKamar = new TipeKamar();
        $tipeKamar->nama = $request->nama;
        $tipeKamar->homestay_id = $request->homestay_id;
        $tipeKamar->deskripsi = $request->deskripsi;
        $tipeKamar->harga = $request->harga;
    
        // Handle file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoData = file_get_contents($foto->getRealPath());
            $tipeKamar->foto = $fotoData;
        }
    
        $tipeKamar->save();
    
        return redirect()->route('pemilik.tipe_kamar.index')->with('success', 'Tipe Kamar berhasil ditambahkan.');
    }

    // Menampilkan detail tipe kamar (Mode Show)
    public function show($id)
    {
        // Ambil data tipe kamar beserta relasi homestay
        $tipeKamar = TipeKamar::with('homestay')->findOrFail($id);

        return view('pemilik.tipe_kamar.index', [
            'mode' => 'show',
            'tipeKamar' => $tipeKamar,
        ]);
    }

    // Menampilkan form edit tipe kamar (Mode Edit)
    public function edit($id)
    {
        $tipeKamar = TipeKamar::findOrFail($id);
        $homestays = Homestay::all(); // Ambil semua data homestay

        return view('pemilik.tipe_kamar.index', [
            'mode' => 'edit',
            'tipeKamar' => $tipeKamar,
            'homestays' => $homestays, // Kirim data homestay ke view
        ]);
    }

    // Memperbarui data tipe kamar (Proses Edit)
    public function update(Request $request, $id)
{
    $request->validate([
        'homestay_id' => 'required|exists:homestays,id',
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'harga' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
    ]);

    $tipeKamar = TipeKamar::findOrFail($id);

    // Proses file foto
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $tipeKamar->foto = file_get_contents($foto->getRealPath()); // Konversi file ke binary
    }

    // Update data
    $tipeKamar->update([
        'homestay_id' => $request->homestay_id,
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
    ]);

    return redirect()->route('pemilik.tipe_kamar.index')
        ->with('success', 'Tipe Kamar berhasil diperbarui.');
}
    // Menghapus data tipe kamar (Proses Delete)
    public function destroy($id)
    {
        // Ambil data tipe kamar yang akan dihapus
        $tipeKamar = TipeKamar::findOrFail($id);

        // Hapus foto jika ada
        if ($tipeKamar->foto) {
            Storage::delete('public/' . $tipeKamar->foto);
        }

        // Hapus data tipe kamar
        $tipeKamar->delete();

        return redirect()->route('pemilik.tipe_kamar.index')
            ->with('success', 'Tipe Kamar berhasil dihapus.');
    }
}