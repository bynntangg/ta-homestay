<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini ada untuk menggunakan Auth

class PenggunaController extends Controller
{
    public function index()
    {
        // Cara yang benar untuk mendapatkan user yang login
        $user = Auth::user(); // Menggunakan method user() dari Auth facade

        if (!$user) {
            return redirect()->route('login');
        }

        return view('dashboard.pengguna', compact('user'));
    }
}
