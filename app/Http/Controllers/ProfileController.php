<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Method untuk menampilkan halaman profil
    public function show()
{
    $user = Auth::user();

    // Pastikan hanya pemilik yang bisa mengakses
    if ($user->role !== 'pemilik') {
        abort(403, 'Unauthorized action.');
    }

    return view('profile', compact('user'));
}

    // Method untuk menangani logout
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user

        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/'); // Redirect ke halaman home setelah logout
    }
}
