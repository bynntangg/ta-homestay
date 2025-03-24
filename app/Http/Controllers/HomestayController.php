<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomestayController extends Controller
{
    public function index()
    {
        // Cek apakah user sudah memiliki homestay
        $homestay = Homestay::where('pemilik_id', Auth::id())->first();

        if ($homestay) {
            // Jika sudah memiliki homestay, tampilkan data show
            return view('pemilik.homestays.index', ['mode' => 'show', 'homestay' => $homestay]);
        } else {
            // Jika belum memiliki homestay, tampilkan form create
            return view('pemilik.homestays.index', ['mode' => 'create']);
        }
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'fasilitas' => 'nullable|array',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);
    
        // Menambahkan pemilik_id dari user yang sedang login
        $validatedData['pemilik_id'] = Auth::id();
    
        // Handle file upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoBinary = file_get_contents($foto->getRealPath()); // Konversi file ke binary
            $validatedData['foto'] = $fotoBinary;
        }
    
        // Membuat homestay baru
        Homestay::create($validatedData);
    
        return redirect()->route('pemilik.homestays.index')->with('success', 'Homestay berhasil ditambahkan.');
    }


    public function edit(Homestay $homestay)
    {
        // Pastikan homestay milik user yang sedang login
        if ($homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    
        // Kembalikan view yang sama seperti create, tetapi dengan mode edit
        return view('pemilik.homestays.index', ['mode' => 'edit', 'homestay' => $homestay]);
    }
    public function update(Request $request, Homestay $homestay)
{
    // Pastikan homestay milik user yang sedang login
    if ($homestay->pemilik_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'deskripsi' => 'required|string',
        'rating' => 'required|integer|between:1,5',
        'fasilitas' => 'nullable|array',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
    ]);

    // Handle file upload
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $fotoBinary = file_get_contents($foto->getRealPath()); // Konversi file ke binary
        $validatedData['foto'] = $fotoBinary;
    }

    // Update data homestay
    $homestay->update($validatedData);

    return redirect()->route('pemilik.homestays.index')->with('success', 'Homestay berhasil diperbarui.');
}
    
    public function destroy(Homestay $homestay)
    {
        // Pastikan homestay milik user yang sedang login
        if ($homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $homestay->delete();

        return redirect()->route('pemilik.homestays.index')->with('success', 'Data homestay berhasil dihapus!');
    }
}