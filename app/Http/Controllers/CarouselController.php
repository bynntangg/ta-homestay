<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Homestay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarouselController extends Controller
{
    // Menampilkan semua carousel (Mode Index)
    public function index()
    {
        $pemilikId = Auth::id();

        $carousels = Carousel::whereHas('homestay', function ($query) use ($pemilikId) {
            $query->where('pemilik_id', $pemilikId);
        })->with('homestay')->get();

        return view('pemilik.carousel.index', [
            'carousels' => $carousels,
            'mode' => 'index'
        ]);
    }

    // Menampilkan form tambah carousel (Mode Create)
    public function create()
    {
        $homestay = Homestay::where('pemilik_id', Auth::id())->first();

        if (!$homestay) {
            return redirect()->route('pemilik.carousel.index')
                ->with('error', 'Anda belum memiliki homestay. Silakan buat homestay terlebih dahulu.');
        }

        return view('pemilik.carousel.index', [
            'homestay' => $homestay,
            'mode' => 'create'
        ]);
    }

    // Menyimpan carousel baru
    public function store(Request $request)
    {
        $request->validate([
            'homestay_id' => 'required|exists:homestays,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:20480',
        ]);

        $carousel = new Carousel();
        $carousel->homestay_id = $request->homestay_id;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $carousel->gambar = file_get_contents($gambar->getRealPath());
        }

        $carousel->save();

        return redirect()->route('pemilik.carousel.index')->with('success', 'Carousel berhasil ditambahkan.');
    }

    // Menampilkan detail carousel (Mode Show)
    public function show($id)
    {
        $carousel = Carousel::with('homestay')->findOrFail($id);

        return view('pemilik.carousel.index', [
            'carousel' => $carousel,
            'mode' => 'show'
        ]);
    }

    // Menampilkan form edit carousel (Mode Edit)
    public function edit($id)
    {
        $carousel = Carousel::whereHas('homestay', function ($query) {
            $query->where('pemilik_id', Auth::id());
        })->with('homestay')->findOrFail($id);

        return view('pemilik.carousel.index', [
            'carousel' => $carousel,
            'homestay' => $carousel->homestay,
            'mode' => 'edit'
        ]);
    }

    // Memperbarui carousel
    public function update(Request $request, $id)
    {
        $request->validate([
            'homestay_id' => 'required|exists:homestays,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
        ]);

        $carousel = Carousel::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $carousel->gambar = file_get_contents($gambar->getRealPath());
        }

        $carousel->update([
            'homestay_id' => $request->homestay_id,
        ]);

        return redirect()->route('pemilik.carousel.index')->with('success', 'Carousel berhasil diperbarui.');
    }

    // Menghapus carousel
    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();

        return redirect()->route('pemilik.carousel.index')->with('success', 'Carousel berhasil dihapus.');
    }
}
