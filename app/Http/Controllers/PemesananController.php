<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Homestay;
use App\Models\TipeKamar;
use App\Models\Kamar;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Mail\PemesananDikonfirmasiMail;
use Illuminate\Support\Facades\Mail;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $step = $request->query('step', 1);
        

        // Tangkap parameter checkin dan checkout dari URL
        if ($request->has('checkin') && $request->has('checkout')) {
            $request->session()->put([
                'checkin' => $request->query('checkin'),
                'checkout' => $request->query('checkout')
            ]);
        }

        // Handle step 3 - Konfirmasi Sukses
        if ($step == 3) {
            $pemesananId = $request->query('pemesanan');
            if (!$pemesananId) {
                return redirect()->route('dashboard.pengguna');
            }

            $pemesanan = Pemesanan::findOrFail($pemesananId);
            return view('pemilik.pemesanan.index', [
                'step' => $step,
                'pemesanan' => $pemesanan,
                'isMultiRoom' => $pemesanan->kamars->groupBy('tipe_kamar_id')->count() > 1
            ]);
        }

        // Handle step 2
        if ($step == 2) {
            // Verify required data exists
            if (!session()->has('checkin') || !session()->has('checkout') || !session()->has('pemesanan.step1')) {
                return redirect()->route('pemilik.pemesanan.index', ['step' => 1])
                    ->with('error', 'Silakan lengkapi informasi pengguna terlebih dahulu');
            }

            $homestayId = session('homestay_id');
            $homestay = Homestay::findOrFail($homestayId);

            // Get room details for multi-room booking
            $tipeKamars = [];
            $totalHarga = 0;
            $jumlahKamar = 0;

            if (session()->has('selected_rooms')) {
                $selectedRooms = session('selected_rooms');
                foreach ($selectedRooms as $room) {
                    $tipeKamar = TipeKamar::find($room['id']);
                    if ($tipeKamar) {
                        $tipeKamars[] = [
                            'id' => $tipeKamar->id,
                            'nama' => $tipeKamar->nama,
                            'harga' => $tipeKamar->harga,
                            'quantity' => $room['quantity'],
                            'available' => Kamar::where('tipe_kamar_id', $room['id'])
                                ->where('ketersediaan', 1)
                                ->count()
                        ];
                        $totalHarga += $tipeKamar->harga * $room['quantity'];
                        $jumlahKamar += $room['quantity'];
                    }
                }
            }

            return view('pemilik.pemesanan.index', [
                'step' => $step,
                'homestay' => $homestay,
                'tipeKamars' => $tipeKamars,
                'totalHarga' => $totalHarga,
                'jumlahKamar' => $jumlahKamar,
                'isMultiRoom' => session()->has('selected_rooms')
            ]);
        }

        // Handle multi-room booking initialization
        if ($request->has('selected_room_ids')) {
            $selectedRooms = json_decode($request->selected_room_ids, true);

            if (empty($selectedRooms)) {
                return redirect()->back()->with('error', 'Silakan pilih kamar terlebih dahulu');
            }

            $homestayId = null;
            $tipeKamars = [];
            $totalHarga = 0;
            $jumlahKamar = 0;

            foreach ($selectedRooms as $room) {
                $tipeKamar = TipeKamar::with('homestay')->find($room['id']);
                if ($tipeKamar) {
                    $homestayId = $tipeKamar->homestay_id;
                    $tipeKamars[] = [
                        'id' => $tipeKamar->id,
                        'nama' => $tipeKamar->nama,
                        'harga' => $tipeKamar->harga,
                        'quantity' => $room['quantity'],
                        'available' => Kamar::where('tipe_kamar_id', $room['id'])
                            ->where('ketersediaan', 1)
                            ->count()
                    ];
                    $totalHarga += $tipeKamar->harga * $room['quantity'];
                    $jumlahKamar += $room['quantity'];
                }
            }

            if (!$homestayId) {
                return redirect()->back()->with('error', 'Data homestay tidak ditemukan');
            }

            $homestay = Homestay::findOrFail($homestayId);

            // Gunakan tanggal dari session jika ada, atau default
            $checkin = session('checkin', now()->format('Y-m-d'));
            $checkout = session('checkout', now()->addDay()->format('Y-m-d'));

            $request->session()->put([
                'homestay_id' => $homestayId,
                'selected_rooms' => $selectedRooms,
                'total_harga' => $totalHarga,
                'jumlah_kamar' => $jumlahKamar,
                'checkin' => $checkin,
                'checkout' => $checkout,
                'tanggal_booking_start' => now()->format('Y-m-d H:i:s'),
                'tanggal_booking_end' => now()->addHours(24)->format('Y-m-d H:i:s')
            ]);

            return view('pemilik.pemesanan.index', [
                'step' => $step,
                'homestay' => $homestay,
                'tipeKamars' => $tipeKamars,
                'totalHarga' => $totalHarga,
                'jumlahKamar' => $jumlahKamar,
                'isMultiRoom' => true
            ]);
        }

        // Original single room booking logic
        $homestayId = session('homestay_id');
        $tipeKamarId = session('tipe_kamar_id');

        if (!$homestayId || !$tipeKamarId) {
            return redirect()->back()->with('error', 'Silakan pilih kamar terlebih dahulu');
        }

        $homestay = Homestay::findOrFail($homestayId);
        $tipeKamar = TipeKamar::findOrFail($tipeKamarId);


        // Gunakan tanggal dari session jika ada, atau default
        if (!session()->has('checkin')) {
            session()->put('checkin', now()->format('Y-m-d'));
            session()->put('checkout', now()->addDay()->format('Y-m-d'));
        }

        $kamartersediaCount = Kamar::where('tipe_kamar_id', $tipeKamarId)
            ->where('ketersediaan', 1)
            ->count();

        return view('pemilik.pemesanan.index', [
            'step' => $step,
            'homestay' => $homestay,
            'tipeKamar' => $tipeKamar,
            'kamartersediaCount' => $kamartersediaCount,
            'isMultiRoom' => false
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'homestay_id' => 'required|exists:homestays,id',
            'tipe_kamar_id' => 'required|exists:tipe_kamars,id',
        ]);

        $kamar = Kamar::where('tipe_kamar_id', $request->tipe_kamar_id)
            ->where('ketersediaan', 1)
            ->first();

        if (!$kamar) {
            return back()->with('error', 'Maaf, kamar ini sudah tidak tersedia');
        }

        $request->session()->put([
            'homestay_id' => $request->homestay_id,
            'tipe_kamar_id' => $request->tipe_kamar_id,
            'kamar_id' => $kamar->id,
            'tanggal_booking_start' => now()->format('Y-m-d H:i:s'),
            'tanggal_booking_end' => now()->addHours(24)->format('Y-m-d H:i:s')
        ]);

        $request->session()->forget(['checkin', 'checkout']);

        return redirect()->route('pemilik.pemesanan.index');
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'homestay_id' => 'required|exists:homestays,id',
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date'
        ]);

        $homestay = Homestay::findOrFail($request->homestay_id);
        $checkin = Carbon::parse($request->checkin_date);
        $checkout = Carbon::parse($request->checkout_date);

        // Hitung total kamar yang sudah dipesan dalam rentang tanggal tersebut
        $bookedRooms = Pemesanan::where('homestay_id', $homestay->id)
            ->where(function ($query) use ($checkin, $checkout) {
                $query->whereBetween('checkin', [$checkin, $checkout])
                    ->orWhereBetween('checkout', [$checkin, $checkout])
                    ->orWhere(function ($q) use ($checkin, $checkout) {
                        $q->where('checkin', '<=', $checkin)
                            ->where('checkout', '>=', $checkout);
                    });
            })
            ->whereIn('status', ['menunggu_konfirmasi', 'dikonfirmasi', 'dibatalkan'])
            ->sum('jumlah_kamar');

        // Hitung total kamar yang tersedia di homestay
        $totalRooms = $homestay->tipe_kamars->sum('jumlah_kamar');

        // Periksa ketersediaan
        $available = ($totalRooms - $bookedRooms) > 0;

        return response()->json([
            'available' => $available,
            'message' => $available
                ? 'Kamar tersedia untuk tanggal yang dipilih'
                : 'Maaf, semua kamar sudah penuh untuk tanggal yang dipilih'
        ]);
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'tipe_identitas' => 'required|string|max:255',
            'nomor_identitas' => 'required|string|max:255',
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
        ]);

        // Handle both single and multi-room bookings
        $jumlahKamar = $request->session()->has('selected_rooms') ?
            $request->session()->get('jumlah_kamar', 1) :
            $request->input('jumlah_kamar', 1);

        // Calculate duration
        $durasi = Carbon::parse($validated['checkout'])->diffInDays(Carbon::parse($validated['checkin']));

        // Save data to session
        $request->session()->put([
            'pemesanan.step1' => $request->only([
                'tipe_identitas',
                'nomor_identitas',
                'jumlah_kamar' => $jumlahKamar
            ]),
            'checkin' => $validated['checkin'],
            'checkout' => $validated['checkout'],
            'jumlah_kamar' => $jumlahKamar,
            'durasi' => $durasi,
            'total_harga' => $this->calculateTotalPrice($request, $durasi),
            'tanggal_booking_start' => now()->format('Y-m-d H:i:s'),
            'tanggal_booking_end' => now()->addHours(24)->format('Y-m-d H:i:s')
        ]);

        return redirect()->route('pemilik.pemesanan.index', ['step' => 2]);
    }

    private function calculateTotalPrice(Request $request, $durasi)
    {
        if (session()->has('selected_rooms')) {
            $selectedRooms = session('selected_rooms');
            $totalHarga = 0;

            foreach ($selectedRooms as $room) {
                $tipeKamar = TipeKamar::find($room['id']);
                if (!$tipeKamar) {
                    continue; // Skip if room type not found
                }
                $totalHarga += $tipeKamar->harga * $room['quantity'] * $durasi;
            }
            return $totalHarga;
        } else {
            $tipeKamarId = session('tipe_kamar_id');
            $tipeKamar = TipeKamar::find($tipeKamarId); // Fixed typo here
            if (!$tipeKamar) {
                return 0; // Or handle this case appropriately
            }
            return $tipeKamar->harga * $request->jumlah_kamar * $durasi;
        }
    }

    public function invoice($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $homestay = Homestay::find($pemesanan->homestay_id);
        return view('pemilik.pemesanan.invoice', compact('pemesanan', 'homestay'));
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $step1Data = $request->session()->get('pemesanan.step1');
            $homestayId = $request->session()->get('homestay_id');
            $checkin = $request->session()->get('checkin');
            $checkout = $request->session()->get('checkout');
            $jumlahKamar = $request->session()->get('jumlah_kamar', 1);

            if (!$step1Data || !$homestayId || !$checkin || !$checkout) {
                return redirect()->route('dashboard.pengguna')->with('error', 'Sesi pemesanan telah kadaluarsa');
            }

            $checkinDate = Carbon::parse($checkin);
            $checkoutDate = Carbon::parse($checkout);
            $durasi = $checkinDate->diffInDays($checkoutDate);

            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

            $qrCodeData = [
                'user_id' => Auth::id(),
                'homestay_id' => $homestayId,
                'checkin' => $checkin,
                'checkout' => $checkout,
                'created_at' => now()->toDateTimeString(),
            ];

            $qrCode = QrCode::format('png')
                ->size(200)
                ->generate(json_encode($qrCodeData));

            $qrCodePath = 'qr_codes/' . uniqid() . '.png';
            Storage::disk('public')->put($qrCodePath, $qrCode);

            $now = Carbon::now();
            $bookingEnd = $now->copy()->addHours(24);

            // Create the booking
            $pemesanan = Pemesanan::create([
                'user_id' => Auth::id(),
                'tanggal_pemesanan' => $now,
                'homestay_id' => $homestayId,
                'tanggal_checkin' => $checkinDate,
                'tanggal_checkout' => $checkoutDate,
                'qr_code' => $qrCodePath,
                'status_pemesanan' => 'menunggu_konfirmasi',
                'payment_proof' => $paymentProofPath,
                'tipe_identitas' => $step1Data['tipe_identitas'],
                'nomor_identitas' => $step1Data['nomor_identitas'],
                'tanggal_booking_start' => $now,
                'tanggal_booking_end' => $bookingEnd,
                'jumlah_kamar' => $jumlahKamar,
                'total_harga' => $request->session()->get('total_harga')
            ]);

            // Handle multi-room booking
            if ($request->session()->has('selected_rooms')) {
                $selectedRooms = $request->session()->get('selected_rooms');

                foreach ($selectedRooms as $room) {
                    $tipeKamar = TipeKamar::find($room['id']);
                    $availableKamars = Kamar::where('tipe_kamar_id', $room['id'])
                        ->where('ketersediaan', 1)
                        ->limit($room['quantity'])
                        ->get();

                    if ($availableKamars->count() < $room['quantity']) {
                        throw new \Exception('Kamar tidak tersedia untuk tipe ' . $tipeKamar->nama);
                    }

                    foreach ($availableKamars as $kamar) {
                        $pemesanan->kamars()->attach($kamar->id, [
                            'harga' => $tipeKamar->harga * $durasi
                        ]);
                        $kamar->update(['ketersediaan' => 0]);
                    }
                }
            } else {
                // Original single room booking logic
                $tipeKamarId = $request->session()->get('tipe_kamar_id');
                $tipeKamar = TipeKamar::findOrFail($tipeKamarId);
                $availableKamars = Kamar::where('tipe_kamar_id', $tipeKamarId)
                    ->where('ketersediaan', 1)
                    ->limit($jumlahKamar)
                    ->get();

                if ($availableKamars->count() < $jumlahKamar) {
                    throw new \Exception('Kamar tidak tersedia');
                }

                foreach ($availableKamars as $kamar) {
                    $pemesanan->kamars()->attach($kamar->id, [
                        'harga' => $tipeKamar->harga * $durasi
                    ]);
                    $kamar->update(['ketersediaan' => 0]);
                }
            }

            DB::commit();

            $request->session()->forget([
                'pemesanan.step1',
                'homestay_id',
                'tipe_kamar_id',
                'kamar_id',
                'checkin',
                'checkout',
                'jumlah_kamar',
                'tanggal_booking_start',
                'tanggal_booking_end',
                'selected_rooms',
                'total_harga'
            ]);

            return redirect()->route('pemilik.pemesanan.index', ['step' => 3, 'pemesanan' => $pemesanan->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Menampilkan riwayat pemesanan pengguna
    public function riwayatPemesanan()
    {
        $user = Auth::user();
        $pemesanans = Pemesanan::with(['homestay', 'kamars.tipeKamar'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pemilik.pemesanan.riwayat', compact('pemesanans'));
    }


    // Menampilkan detail pemesanan
    public function showDetailPemesanan($id)
    {
        $pemesanan = Pemesanan::with(['homestay', 'kamars.tipeKamar', 'user'])
            ->where('id', $id)
            ->firstOrFail();

        // Pastikan pemesanan milik user yang login
        if ($pemesanan->user_id != Auth::id()) {
            abort(403);
        }

        return view('pemilik.pemesanan.detail', compact('pemesanan'));
    }


    public function detailUser($id)
    {
        $pemesanan = Pemesanan::with([
            'homestay',
            'kamars.tipeKamar',
            'user'
        ])->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Get homestays data if needed (only if you're actually using it in the view)
        $homestays = Homestay::whereHas('pemesanans', function ($query) {
            $query->where('status_pemesanan', 'dikonfirmasi');
        })
            ->with(['pemesanans' => function ($query) {
                $query->where('status_pemesanan', 'dikonfirmasi')
                    ->with(['user', 'kamars.tipeKamar']);
            }])
            ->get();

        return view('pemilik.pemesanan.detail-user', compact('pemesanan', 'homestays'));
    }

    public function konfirmasi()
    {
        $pemesanans = Pemesanan::where('status_pemesanan', 'menunggu_konfirmasi')
            ->with(['user', 'homestay', 'kamars.tipeKamar'])
            ->paginate(10);

        $homestays = Homestay::whereHas('pemesanans', function ($query) {
            $query->where('status_pemesanan', 'dikonfirmasi');
        })
            ->with(['pemesanans' => function ($query) {
                $query->where('status_pemesanan', 'dikonfirmasi')
                    ->with(['user', 'kamars.tipeKamar']);
            }])
            ->get();

        return view('pemilik.pemesanan.konfirmasi', compact('pemesanans', 'homestays'));
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $invoiceFile = 'invoice_' . $pemesanan->id . '.pdf';
        return view('pemilik.pemesanan.detail', compact('pemesanan', 'invoiceFile'));
    }

    public function prosesKonfirmasi(Request $request, $id)
{
    DB::beginTransaction();

    try {
        $pemesanan = Pemesanan::with(['user', 'homestay', 'kamars'])->findOrFail($id);

        // Generate QR Code jika belum ada
        if (!$pemesanan->qr_code || !Storage::disk('public')->exists($pemesanan->qr_code)) {
            $qrCodeData = [
                'pemesanan_id' => $pemesanan->id,
                'user_id' => $pemesanan->user_id,
                'homestay_id' => $pemesanan->homestay_id,
                'checkin' => $pemesanan->tanggal_checkin,
                'checkout' => $pemesanan->tanggal_checkout,
            ];

            $qrCode = QrCode::format('png')
                ->size(200)
                ->generate(json_encode($qrCodeData));

            $qrCodePath = 'qr_codes/' . uniqid() . '.png';
            Storage::disk('public')->put($qrCodePath, $qrCode);
            $pemesanan->update(['qr_code' => $qrCodePath]);
            $pemesanan->refresh(); // Refresh model untuk mendapatkan nilai terbaru
        }

        $pemesanan->update([
            'status_pemesanan' => 'dikonfirmasi',
            'tanggal_konfirmasi' => now(),
            'invoice_path' => null // Kosongkan karena tidak ada PDF
        ]);

        // Kirim email (tanpa lampiran PDF)
        Mail::to($pemesanan->user->email)
            ->send(new PemesananDikonfirmasiMail($pemesanan, null));

        DB::commit();

        return redirect()->back()->with('success', 'Pemesanan berhasil dikonfirmasi dan email telah dikirim.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Gagal mengkonfirmasi pemesanan: ' . $e->getMessage());
    }
}


    public function prosesBatalUser($id)
    {
        $pemesanan = Pemesanan::with('kamars')->findOrFail($id);

        // Validasi kepemilikan
        if ($pemesanan->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validasi status pemesanan
        if ($pemesanan->status_pemesanan != 'menunggu_konfirmasi') {
            return back()->with('error', 'Hanya pemesanan dengan status menunggu konfirmasi yang bisa dibatalkan');
        }

        DB::beginTransaction();
        try {
            // Update status pemesanan
            $pemesanan->update([
                'status_pemesanan' => 'dibatalkan',
                'status_pembayaran' => 'ditolak',
                'waktu_pembatalan' => now()
            ]);

            // Kembalikan ketersediaan kamar
            foreach ($pemesanan->kamars as $kamar) {
                $kamar->update(['ketersediaan' => 1]); // 1 = tersedia
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pemesanan berhasil dibatalkan. Silahkan hubungi contact owner homestay untuk melakukan refund.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membatalkan pemesanan: ' . $e->getMessage());
        }
    }
    

    public function prosesBatalAdmin($id)
    {
        $pemesanan = Pemesanan::with(['kamars', 'homestay'])->findOrFail($id);

        // Validasi kepemilikan homestay
        if (!Auth::user()->homestays->contains($pemesanan->homestay_id)) {
            return back()->with('error', 'Anda tidak memiliki akses ke pemesanan ini');
        }

        // Validasi status pemesanan
        if ($pemesanan->status_pemesanan != 'menunggu_konfirmasi') {
            return back()->with('error', 'Hanya pemesanan dengan status menunggu konfirmasi yang bisa dibatalkan');
        }

        DB::beginTransaction();
        try {
            // Update status pemesanan
            $pemesanan->update([
                'status_pemesanan' => 'dibatalkan',
                'alasan_pembatalan' => 'Dibatalkan oleh pemilik',
                'waktu_pembatalan' => now()
            ]);

            // Kembalikan ketersediaan kamar
            foreach ($pemesanan->kamars as $kamar) {
                $kamar->update(['ketersediaan' => 1]); // 1 = tersedia
            }

            DB::commit();
            return back()->with('success', 'Pemesanan berhasil dibatalkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membatalkan pemesanan: ' . $e->getMessage());
        }
    }

    public function checkout(Pemesanan $pemesanan)
    {
        // Validasi kepemilikan homestay
        if (!Auth::user()->homestays->contains($pemesanan->homestay_id)) {
            return back()->with('error', 'Anda tidak memiliki akses ke pemesanan ini');
        }
    
        // Validasi status pemesanan
        if ($pemesanan->status_pemesanan !== 'check_in') {
            return back()->with('error', 'Hanya tamu yang sudah check-in yang bisa check-out');
        }
    
        DB::beginTransaction();
        try {
            // Update status pemesanan
            $pemesanan->update([
                'status_pemesanan' => 'check_out',
                'waktu_checkout' => now()
            ]);
    
            // Update ketersediaan kamar menjadi true (1)
            foreach ($pemesanan->kamars as $kamar) {
                $kamar->update(['ketersediaan' => 1]);
            }
    
            DB::commit();
            return back()->with('success', 'Check-out berhasil dilakukan dan kamar telah tersedia kembali');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal melakukan check-out: ' . $e->getMessage());
        }
    }

    public function checkin(Pemesanan $pemesanan)
    {
        // Validasi kepemilikan homestay
        if (!Auth::user()->homestays->contains($pemesanan->homestay_id)) {
            return back()->with('error', 'Anda tidak memiliki akses ke pemesanan ini');
        }

        if ($pemesanan->status_pemesanan !== 'dikonfirmasi') {
            return back()->with('error', 'Hanya pemesanan yang sudah dikonfirmasi yang bisa check-in');
        }

        $today = now()->format('Y-m-d');
        $checkinDate = Carbon::parse($pemesanan->tanggal_checkin)->format('Y-m-d');

        if ($today < $checkinDate) {
            return back()->with('error', 'Belum waktunya check-in. Tanggal check-in dimulai pada ' . $checkinDate);
        }

        DB::beginTransaction();
        try {
            $pemesanan->update([
                'status_pemesanan' => 'check_in',
                'tanggal_checkin_aktual' => now()
            ]);

            DB::commit();
            return back()->with('success', 'Check-in berhasil dilakukan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal melakukan check-in: ' . $e->getMessage());
        }
    }

}
