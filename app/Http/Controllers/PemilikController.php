<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class PemilikController extends Controller
{
    public function index()
    {
        // Cara yang benar untuk mendapatkan user yang login
        $user = Auth::user(); // Menggunakan method user() dari Auth facade

        if (!$user) {
            return redirect()->route('login');
        }

        return view('dashboard.pemilik', compact('user'));
    }
}
