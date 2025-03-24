<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function pengguna()
    {
        return view('dashboard.pengguna');
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
