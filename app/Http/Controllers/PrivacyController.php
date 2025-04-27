<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;

class PrivacyController extends Controller
{
    public function index()
{
    $pemesanan = Pemesanan::where('user_id', Auth::id())->first();
    return view('privacy' , compact('pemesanan'));
}
}
