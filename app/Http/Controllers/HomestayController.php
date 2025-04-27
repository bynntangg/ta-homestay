<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;
use Carbon\Carbon;
use App\Models\TipeKamar;
use Illuminate\Support\Facades\DB;

class HomestayController extends Controller
{
    // Fasilitas yang tersedia dengan label yang lebih user-friendly
    private $availableFacilities = [
        'wifi' => 'WiFi',
        'parkir' => 'Parkir',
        'ac' => 'AC',
        'kolam_renang' => 'Kolam Renang',
        'breakfast' => 'Sarapan',
        'tv' => 'TV',
        'shower' => 'Shower',
        'kitchen' => 'Dapur'
    ];

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $pemesanan = Pemesanan::where('user_id', Auth::id())->first();
        $homestay = Homestay::where('pemilik_id', Auth::id())->first();

        return view('pemilik.homestays.index', [
            'mode' => $homestay ? 'show' : 'create',
            'homestay' => $homestay,
            'availableFacilities' => $this->availableFacilities,
            'pemesanan' => $pemesanan
        ]);
    }

    public function pengguna()
    {
        $homestays = Homestay::where('status', 'active')
            ->with(['tipe_kamars' => function ($query) {
                $query->whereHas('kamars', function ($q) {
                    $q->where('ketersediaan', 1);
                });
            }])
            ->get();

        return view('dashboard.pengguna', [
            'homestays' => $homestays,
            'availableFacilities' => $this->availableFacilities
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validatedData = $this->validateHomestayData($request);
        $validatedData['pemilik_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $this->processImage($request->file('foto'));
        }

        $validatedData['fasilitas'] = $this->filterValidFacilities($request->input('fasilitas', []));

        Homestay::create($validatedData);

        return redirect()->route('pemilik.homestays.index')
            ->with('success', 'Homestay berhasil ditambahkan.');
    }

    public function show($id, Request $request)
    {
        $pemesanan = Pemesanan::where('user_id', Auth::id())->first();
        $homestay = Homestay::with(['tipe_kamars.kamars', 'carousels', 'reviews.user'])->findOrFail($id);

        $checkin = $request->query('checkin');
        $checkout = $request->query('checkout');

        // Validasi tanggal
        if ($checkin && $checkout) {
            try {
                $checkinDate = Carbon::parse($checkin);
                $checkoutDate = Carbon::parse($checkout);

                if ($checkoutDate <= $checkinDate) {
                    // Tanggal tidak valid, reset ke default
                    $checkin = null;
                    $checkout = null;
                }
            } catch (\Exception $e) {
                // Format tanggal invalid, reset ke default
                $checkin = null;
                $checkout = null;
            }
        }
        

        // Hitung kamar tersedia untuk setiap tipe kamar
        $tipe_kamars = $homestay->tipe_kamars->map(function ($tipe) use ($checkin, $checkout) {
            if ($checkin && $checkout) {
                // Hitung kamar yang sudah dibooking pada rentang tanggal
                $bookedRooms = DB::table('pemesanan_kamar') // Ganti dengan nama tabel yang benar
                    ->join('pemesanans', 'pemesanan_kamar.pemesanan_id', '=', 'pemesanans.id')
                    ->whereIn('pemesanans.status_pemesanan', ['dikonfirmasi', 'check_in'])
                    ->whereIn('pemesanan_kamar.kamar_id', function ($query) use ($tipe) {
                        $query->select('id')
                            ->from('kamars')
                            ->where('tipe_kamar_id', $tipe->id);
                    })
                    ->where(function ($query) use ($checkin, $checkout) {
                        $query->whereBetween('pemesanans.tanggal_checkin', [$checkin, $checkout])
                            ->orWhereBetween('pemesanans.tanggal_checkout', [$checkin, $checkout])
                            ->orWhere(function ($q) use ($checkin, $checkout) {
                                $q->where('pemesanans.tanggal_checkin', '<', $checkin)
                                    ->where('pemesanans.tanggal_checkout', '>', $checkout);
                            });
                    })
                    ->count();

                // Total kamar dari tipe ini
                $totalRooms = $tipe->kamars->count();
                $tipe->available_rooms_count = max(0, $totalRooms - $bookedRooms);
            } else {
                // Jika tidak ada tanggal, hitung semua kamar yang tersedia
                $tipe->available_rooms_count = $tipe->kamars->where('ketersediaan', 1)->count();
            }

            return $tipe;
        });

        // Rating dan ulasan
        $averageRating = $homestay->ulasans()->avg('rating') ?? 0;
        $totalReviews = $homestay->ulasans()->count();

        // Hitung jumlah rating per bintang
        $ratingCounts = [
            5 => $homestay->ulasans()->where('rating', 5)->count(),
            4 => $homestay->ulasans()->where('rating', 4)->count(),
            3 => $homestay->ulasans()->where('rating', 3)->count(),
            2 => $homestay->ulasans()->where('rating', 2)->count(),
            1 => $homestay->ulasans()->where('rating', 1)->count(),
        ];

        // Ambil ulasan dengan pagination
        $reviews = $homestay->ulasans()
            ->with('user')
            ->latest()
            ->paginate(5);

        return view('pemilik.homestays.detail', [
            'homestay' => $homestay,
            'checkin' => request('checkin', old('checkin')),
            'checkout' => request('checkout', old('checkout')),
            'pemesanan' => $pemesanan,
            'averageRating' => $averageRating,
            'totalReviews' => $totalReviews,
            'ratingCounts' => $ratingCounts,
            'reviews' => $reviews,
        ])->with('availableFacilities', $this->availableFacilities);
    }

    public function edit(Homestay $homestay)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('pemilik.homestays.index', [
            'mode' => 'edit',
            'homestay' => $homestay,
            'availableFacilities' => $this->availableFacilities
        ]);
    }

    public function update(Request $request, Homestay $homestay)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $this->validateHomestayData($request);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $this->processImage($request->file('foto'));
        }

        $validatedData['fasilitas'] = $this->filterValidFacilities($request->input('fasilitas', []));

        $homestay->update($validatedData);

        return redirect()->route('pemilik.homestays.index')
            ->with('success', 'Homestay berhasil diperbarui.');
    }

    public function destroy(Homestay $homestay)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $homestay->delete();

        return redirect()->route('pemilik.homestays.index')
            ->with('success', 'Data homestay berhasil dihapus!');
    }

    private function validateHomestayData(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'fasilitas' => 'nullable|array',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_bank' => 'required|string|max:100',
            'nomor_rekening' => 'required|string|max:50',
            'atas_nama' => 'required|string|max:100',
        ]);
    }

    private function processImage($image)
    {
        return file_get_contents($image->getRealPath());
    }

    private function filterValidFacilities($facilities)
    {
        if (!is_array($facilities)) {
            return [];
        }

        return array_filter($facilities, function ($key) {
            return array_key_exists($key, $this->availableFacilities);
        }, ARRAY_FILTER_USE_KEY);
    }
}
