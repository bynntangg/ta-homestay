<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        // Cara yang benar untuk mendapatkan user yang login
        $user = Auth::user(); // Menggunakan method user() dari Auth facade

        if (!$user) {
            return redirect()->route('login');
        }

        return view('dashboard.master', compact('user'));
    }
}
