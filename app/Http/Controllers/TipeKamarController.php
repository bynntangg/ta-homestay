<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use App\Models\Homestay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TipeKamarController extends Controller
{
    // Menampilkan daftar tipe kamar (Mode Index)
    public function index()
    {
        // Ambil ID pemilik yang sedang login
        $pemilikId = Auth::id();

        // Ambil tipe kamar dari homestay yang dimiliki oleh pemilik tersebut
        $tipeKamars = TipeKamar::whereHas('homestay', function ($query) use ($pemilikId) {
            $query->where('pemilik_id', $pemilikId);
        })->with('homestay')->get();

        return view('pemilik.tipe_kamar.index', [
            'tipeKamars' => $tipeKamars,
            'mode' => 'index'
        ]);
    }

    // Menampilkan form tambah tipe kamar (Mode Create)
    public function create()
    {
        // Ambil homestay pertama milik pemilik yang login (atau sesuaikan logika bisnis Anda)
        $homestay = Homestay::where('pemilik_id', Auth::id())->first();

        // Jika pemilik belum punya homestay, redirect dengan pesan error
        if (!$homestay) {
            return redirect()->route('pemilik.tipe_kamar.index')
                ->with('error', 'Anda belum memiliki homestay. Silakan buat homestay terlebih dahulu.');
        }

        return view('pemilik.tipe_kamar.index', [
            'homestay' => $homestay, // Kirim data homestay ke view
            'mode' => 'create'
        ]);
    }
    public function store(Request $request)
    {
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
        $tipeKamar = TipeKamar::whereHas('homestay', function ($query) {
            $query->where('pemilik_id', Auth::id());
        })->with('homestay')->findOrFail($id); // Tambahkan with('homestay')

        return view('pemilik.tipe_kamar.index', [
            'tipeKamar' => $tipeKamar,
            'homestay' => $tipeKamar->homestay, // Tambahkan ini
            'mode' => 'edit'
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
