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
        $homestay = Homestay::where('pemilik_id', Auth::id())->first();

        if ($homestay) {
            return view('pemilik.homestays.index', ['mode' => 'show', 'homestay' => $homestay]);
        } else {
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validatedData['pemilik_id'] = Auth::id();

        // Simpan gambar ke storage & simpan nama file ke database
        if ($request->hasFile('foto')) {
            $fotoNama = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('public/homestays', $fotoNama);
            $validatedData['foto'] = $fotoNama;
        }

        Homestay::create($validatedData);

        return redirect()->route('pemilik.homestays.index')->with('success', 'Homestay berhasil ditambahkan.');
    }

    public function edit(Homestay $homestay)
    {
        if ($homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('pemilik.homestays.index', ['mode' => 'edit', 'homestay' => $homestay]);
    }

    public function update(Request $request, Homestay $homestay)
    {
        if ($homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'fasilitas' => 'nullable|array',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload dan hapus foto lama jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($homestay->foto) {
                Storage::delete('public/homestays/' . $homestay->foto);
            }

            // Simpan foto baru
            $fotoNama = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('public/homestays', $fotoNama);
            $validatedData['foto'] = $fotoNama;
        }

        $homestay->update($validatedData);

        return redirect()->route('pemilik.homestays.index')->with('success', 'Homestay berhasil diperbarui.');
    }

    public function destroy(Homestay $homestay)
    {
        if ($homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Hapus file gambar dari storage
        if ($homestay->foto) {
            Storage::delete('public/homestays/' . $homestay->foto);
        }

        $homestay->delete();

        return redirect()->route('pemilik.homestays.index')->with('success', 'Data homestay berhasil dihapus!');
    }
}
