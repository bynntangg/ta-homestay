<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homestay;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Kamar;
use App\Models\TipeKamar;
use App\Models\Pemesanan;   
use App\Models\User;

class DashboardController extends Controller
{

    public function pengguna()
    {
        $homestays = Homestay::select('id', 'nama', 'foto', 'rating')
            ->orderBy('nama')
            ->get();
            
        $pemesanan = Pemesanan::where('user_id', Auth::id())->first();
    
        // Ambil semua review dari homestay yang memiliki rating
        $reviews = Review::with(['user', 'homestay'])
                        ->whereNotNull('rating') // Pastikan hanya yang memiliki rating
                        ->latest()
                        ->take(3) // Limit 3 review terbaru
                        ->get();
    
        return view('dashboard.pengguna', compact('homestays', 'pemesanan', 'reviews'));
    }


    public function pemilik()
    {
        return view('dashboard.pemilik');
    }

    public function master()
    {
        return view('dashboard.master');
    }

    public function management()
{
    // Hitung statistik utama
    $totalHomestays = Homestay::count();
    $totalKamars = Kamar::count();
    $tipeKamarsCount = TipeKamar::count();
    $totalPemesanans = Pemesanan::count();

    // Data homestay dengan jumlah kamar
    $homestays = Homestay::withCount('kamars')->get();

    // Data tipe kamar dengan jumlah kamar
    $tipeKamars = TipeKamar::withCount('kamars')->get();

    return view('master.management', [
        'totalHomestays' => $totalHomestays,
        'totalKamars' => $totalKamars,
        'tipeKamarsCount' => $tipeKamarsCount,
        'totalPemesanans' => $totalPemesanans,
        'homestays' => $homestays,
        'tipeKamars' => $tipeKamars
    ]);
}
}
