<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homestay;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function pengguna()
    {
        $homestays = Homestay::select('id', 'nama', 'foto','rating') // Hanya ambil field yang diperlukan
            ->orderBy('nama')
            ->get();
            
        return view('dashboard.pengguna', compact('homestays'));
    }

    public function pemilik()
    {
        return view('dashboard.pemilik');
    }

    public function master()
    {
        return view('dashboard.master');
    }
}
