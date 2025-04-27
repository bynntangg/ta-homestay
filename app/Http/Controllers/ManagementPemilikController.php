<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ManagementPemilikController extends Controller
{
        public function index()
        {
                // Ambil ID homestay yang dimiliki oleh pemilik yang login
                $homestayIds = Auth::user()->homestays->pluck('id')->toArray();

                // Hitung total pemesanan untuk homestay pemilik
                $totalPemesanans = Pemesanan::whereIn('homestay_id', $homestayIds)->count();

                // Hitung pemesanan berdasarkan status
                $pemesanansDikonfirmasi = Pemesanan::whereIn('homestay_id', $homestayIds)
                        ->where('status_pemesanan', 'dikonfirmasi')
                        ->count();

                $pemesanansMenunggu = Pemesanan::whereIn('homestay_id', $homestayIds)
                        ->where('status_pemesanan', 'menunggu_konfirmasi')
                        ->count();

                $pemesanansCheckIn = Pemesanan::whereIn('homestay_id', $homestayIds)
                        ->where('status_pemesanan', 'check_in')
                        ->count();

                $pemesanansCheckOut = Pemesanan::whereIn('homestay_id', $homestayIds)
                        ->where('status_pemesanan', 'check_out')
                        ->count();

                $pemesanansDibatalkan = Pemesanan::whereIn('homestay_id', $homestayIds)
                        ->where('status_pemesanan', 'dibatalkan')
                        ->count();

                // Hitung total pendapatan dari tabel pivot pemesanan_kamar
                $totalPendapatan = DB::table('pemesanan_kamar')
                        ->join('pemesanans', 'pemesanan_kamar.pemesanan_id', '=', 'pemesanans.id')
                        ->whereIn('pemesanans.homestay_id', $homestayIds)
                        ->whereIn('pemesanans.status_pemesanan', ['dikonfirmasi', 'check_in', 'check_out'])
                        ->sum('pemesanan_kamar.harga');

                // Ambil 10 pemesanan terbaru
                $pemesanansTerbaru = Pemesanan::with(['user', 'homestay', 'kamars'])
                        ->whereIn('homestay_id', $homestayIds)
                        ->select('pemesanans.*')
                        ->selectSub(function ($query) {
                                $query->select(DB::raw('SUM(pemesanan_kamar.harga)'))
                                        ->from('pemesanan_kamar')
                                        ->whereColumn('pemesanan_kamar.pemesanan_id', 'pemesanans.id');
                        }, 'total_harga_pivot')
                        ->orderBy('created_at', 'desc')
                        ->take(10)
                        ->get();

                // Hitung pendapatan bulanan
                $monthlyRevenue = [];
                $monthlyBookings = []; // Array untuk menyimpan total pemesanan per bulan

                for ($i = 1; $i <= 12; $i++) {
                        // Pendapatan bulanan
                        $revenue = DB::table('pemesanan_kamar')
                                ->join('pemesanans', 'pemesanan_kamar.pemesanan_id', '=', 'pemesanans.id')
                                ->whereIn('pemesanans.homestay_id', $homestayIds)
                                ->whereIn('pemesanans.status_pemesanan', ['dikonfirmasi', 'check_in', 'check_out'])
                                ->whereYear('pemesanans.created_at', Carbon::now()->year)
                                ->whereMonth('pemesanans.created_at', $i)
                                ->sum('pemesanan_kamar.harga');

                        $monthlyRevenue[] = $revenue ?? 0;

                        // Total pemesanan bulanan
                        $bookings = Pemesanan::whereIn('homestay_id', $homestayIds)
                                ->whereYear('created_at', Carbon::now()->year)
                                ->whereMonth('created_at', $i)
                                ->count();

                        $monthlyBookings[] = $bookings;
                }


                return view('pemilik.management.index', compact(
                        'totalPemesanans',
                        'pemesanansDikonfirmasi',
                        'pemesanansMenunggu',
                        'pemesanansCheckIn',
                        'pemesanansCheckOut',
                        'pemesanansDibatalkan',
                        'totalPendapatan',
                        'pemesanansTerbaru',
                        'monthlyRevenue',
                        'monthlyBookings'
                ));
        }

        public function generateReport()
        {
                $pemesanans = Pemesanan::with(['user', 'homestay'])
                        ->whereIn('status_pemesanan', ['dikonfirmasi', 'check_in', 'check_out'])
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get()
                        ->map(function ($item) {
                                // Pastikan total harga tersedia
                                $item->total_harga_display = $item->total_harga_pivot ?? $item->total_harga ?? 0;
                                return $item;
                        });
                $totalSemuaHarga = $pemesanans->sum(function ($pemesanan) {
                        return $pemesanan->total_harga_pivot ?? $pemesanan->total_harga ?? 0;
                });

                $data = [
                        'title' => 'LAPORAN PEMESANAN HOMESTAY',
                        'date' => now()->format('d/m/Y'),
                        'pemesanans' => $pemesanans,
                        'totalSemuaHarga' => $totalSemuaHarga
                ];

                return Pdf::loadView('pemilik.management.laporan', $data)
                        ->download('laporan-pemesanan-terbaru-' . now()->format('Y-m-d') . '.pdf');
        }
}
