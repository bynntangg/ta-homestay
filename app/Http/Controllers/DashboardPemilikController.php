<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use App\Models\Pemesanan;
use App\Models\Kamar;
use App\Models\PemesananKamar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        $pemilikId = Auth::id();

        // Ambil semua homestay yang dimiliki oleh user ini
        $homestayIds = Homestay::where('pemilik_id', $pemilikId)->pluck('id');

        // Total pemasukan bulan ini
        $totalPemasukanBulanan = PemesananKamar::whereHas('kamar', function ($query) use ($homestayIds) {
                $query->whereIn('homestay_id', $homestayIds);
            })
            ->whereHas('pemesanan', function ($query) {
                $query->where('status_pemesanan', 'success')
                      ->whereMonth('tanggal_pemesanan', Carbon::now()->month);
            })
            ->sum('harga');

        // Total pemasukan tahunan
        $totalPemasukanTahunan = PemesananKamar::whereHas('kamar', function ($query) use ($homestayIds) {
                $query->whereIn('homestay_id', $homestayIds);
            })
            ->whereHas('pemesanan', function ($query) {
                $query->where('status_pemesanan', 'success')
                      ->whereYear('tanggal_pemesanan', Carbon::now()->year);
            })
            ->sum('harga');

        // Tasks Progress = % kamar terisi
        $totalKamar = Kamar::whereIn('homestay_id', $homestayIds)->count();

        $kamarTerisi = PemesananKamar::whereHas('kamar', function ($query) use ($homestayIds) {
                $query->whereIn('homestay_id', $homestayIds);
            })
            ->whereHas('pemesanan', function ($query) {
                $query->where('status_pemesanan', 'success');
            })
            ->count();

        $progressPersen = $totalKamar > 0 ? round(($kamarTerisi / $totalKamar) * 100) : 0;

        // Pending requests = status pending
        $pendingRequests = Pemesanan::whereHas('pemesananKamars.kamar', function ($query) use ($homestayIds) {
                $query->whereIn('homestay_id', $homestayIds);
            })
            ->where('status_pemesanan', 'pending')
            ->distinct('id')
            ->count('id');

        // Data per bulan
        $dataPerBulan = PemesananKamar::whereHas('kamar', function ($query) use ($homestayIds) {
            $query->whereIn('homestay_id', $homestayIds);
        })
        ->join('pemesanans', 'pemesanan_kamars.pemesanan_id', '=', 'pemesanans.id') // ✅ Gabungkan dengan tabel pemesanans
        ->where('pemesanans.status_pemesanan', 'success')
        ->selectRaw('MONTH(pemesanans.tanggal_pemesanan) as bulan, SUM(pemesanan_kamars.harga) as total') // ✅ Pakai tanggal_pemesanan dari pemesanans
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();
    
        $totalHomestay = Homestay::count();

        return view('pemilik.dashboard.index', compact(
            'totalPemasukanBulanan',
            'totalPemasukanTahunan',
            'progressPersen',
            'pendingRequests', 'dataPerBulan',
            'totalHomestay'
        ));
    }
}
