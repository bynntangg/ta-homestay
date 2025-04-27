<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;


class AboutController extends Controller
{
    // In AboutController.php
public function index()
{
    $pemesanan = Pemesanan::where('user_id', Auth::id())->first();
    return view('about', compact('pemesanan'));
}
}
