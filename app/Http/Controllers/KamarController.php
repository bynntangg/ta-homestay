<?php
namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TipeKamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::with('tipeKamar')->get();
        $tipeKamars = TipeKamar::all();
        $mode = 'index';
        return view('pemilik.kamars.index', compact('kamars', 'tipeKamars', 'mode'));
    }

    public function create()
    {
        $tipeKamars = TipeKamar::all();
        $mode = 'create';
        return view('pemilik.kamars.index', compact('tipeKamars', 'mode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:255',
            'ketersediaan' => 'required|boolean',
            'tipe_kamar_id' => 'required|exists:tipe_kamars,id',
        ]);

        Kamar::create($request->all());

        return redirect()->route('pemilik.kamars.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        $tipeKamars = TipeKamar::all();
        $mode = 'edit';
        return view('pemilik.kamars.index', compact('kamar', 'tipeKamars', 'mode'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor' => 'required|string|max:255',
            'ketersediaan' => 'required|boolean',
            'tipe_kamar_id' => 'required|exists:tipe_kamars,id',
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->update($request->all());

        return redirect()->route('pemilik.kamars.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);
        $mode = 'show';
        return view('pemilik.kamars.index', compact('kamar', 'mode'));
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return redirect()->route('pemilik.kamars.index')->with('success', 'Kamar berhasil dihapus.');
    }
}