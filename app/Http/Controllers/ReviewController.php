<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Homestay;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'homestay'])
                        ->whereNotNull('rating')
                        ->latest()
                        ->take(3)
                        ->get();
                        
        return view('dashboard.pengguna', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'homestay_id' => 'required|exists:homestays,id',
            'rating' => 'required|integer|between:1,5',
            'komentar' => 'required|string|max:500',
        ]);

        // Cek apakah user sudah pernah memesan dan sudah check_out
        $completedBooking = Pemesanan::where('user_id', Auth::id())
            ->where('homestay_id', $request->homestay_id)
            ->where('status_pemesanan', 'check_out')
            ->exists();

        if (!$completedBooking) {
            return back()->with('error', 'Anda harus menyelesaikan menginap (check-out) terlebih dahulu sebelum memberikan ulasan.');
        }

        // Cek apakah sudah pernah memberikan review
        if (Review::where('user_id', Auth::id())
            ->where('homestay_id', $request->homestay_id)
            ->exists()) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk homestay ini.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'homestay_id' => $request->homestay_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'tanggal_ulasan' => now(),
        ]);

        return back()->with('success', 'Ulasan berhasil ditambahkan!');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $review->delete();

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}