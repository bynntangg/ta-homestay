<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan - WatHome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            window.onload = function() {
                Swal.fire({
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            };
        </script>
    @endif
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-diproses {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .status-dikonfirmasi {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .status-dibatalkan {
            background-color: #FEE2E2;
            color: #991B1B;
        }

        .status-selesai {
            background-color: #DBEAFE;
            color: #1E40AF;
        }

        .header {
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .header.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .timeline {
            position: relative;
            padding-left: 1.5rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0.5rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #E5E7EB;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1.5rem;
            top: 0.25rem;
            width: 1rem;
            height: 1rem;
            border-radius: 9999px;
            background-color: #E5E7EB;
            border: 3px solid white;
        }

        .timeline-item.active::before {
            background-color: #3B82F6;
        }

        .timeline-item.completed::before {
            background-color: #10B981;
        }

        .facility-badge {
            transition: all 0.2s ease;
        }

        .facility-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .qr-code-container {
            transition: all 0.3s ease;
        }

        .qr-code-container:hover {
            transform: scale(1.05);
        }

        /* Header Styles - Classic Look */
        .header {
            background: linear-gradient(135deg, #1a3a8a 0%, #2563eb 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .header.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="bg-gray-50">
    <header class="header py-4 text-white">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="/"
                class="text-3xl font-bold text-white flex items-center transition duration-300 hover:text-blue-100">
                <i class="fas fa-home mr-3 text-blue-200"></i>
                <span>WatHome</span>
                <span class="text-xs ml-2 bg-white bg-opacity-20 text-white px-2 py-1 rounded-full">.com</span>
            </a>

            <div class="flex items-center space-x-6">
                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-3 focus:outline-none">
                            <div class="text-right hidden md:block">
                                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-blue-100">Akun Saya</p>
                            </div>
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ffffff&color=3B82F6"
                                    alt="Profile" class="w-10 h-10 rounded-full border-2 border-blue-200 shadow-sm">
                                <span
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></span>
                            </div>
                        </button>
                        <div
                            class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-md py-2 opacity-0 invisible transition-all duration-300 transform translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 z-50 divide-y divide-gray-100">
                            <div class="px-4 py-3">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                                    <i class="fas fa-user-circle mr-3 text-gray-400 w-5 text-center"></i> Profil Saya
                                </a>
                                <a href="{{ route('pemilik.pemesanan.riwayat') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-home mr-3 text-gray-400 w-5 text-center"></i> Pesanan Saya
                                </a>
                            </div>
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                                        <i class="fas fa-sign-out-alt mr-3 text-gray-400 w-5 text-center"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}"
                            class="text-white hover:text-blue-100 font-medium px-3 py-1.5 rounded-lg transition duration-300 hover:bg-white hover:bg-opacity-10">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-white text-blue-600 px-5 py-2.5 rounded-lg hover:shadow-md transition duration-300 hover:bg-blue-50">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav aria-label="Breadcrumb" class="flex items-center text-sm text-gray-600 mb-6">
            <a href="{{ route('dashboard.pengguna') }}" class="hover:text-blue-600 transition">
                <i class="fas fa-home mr-1"></i> Beranda
            </a>
            <span class="mx-2">/</span>
            <a href="{{ route('pemilik.pemesanan.riwayat') }}" class="hover:text-blue-600 transition">
                Riwayat Pemesanan
            </a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 font-medium" aria-current="page">Detail Pesanan #{{ $pemesanan->id }}</span>
        </nav>

        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                <!-- Header with status -->
                <div
                    class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Detail Pesanan #{{ $pemesanan->id }}</h1>
                        <p class="text-sm text-gray-600">Tanggal Pemesanan:
                            {{ $pemesanan->created_at->translatedFormat('d M Y H:i') }}</p>
                    </div>
                    <div class="mt-2 md:mt-0">
                        @php
                            $statusClass =
                                [
                                    'menunggu_konfirmasi' => 'status-diproses',
                                    'dikonfirmasi' => 'status-dikonfirmasi',
                                    'dibatalkan' => 'status-dibatalkan',
                                    'selesai' => 'status-selesai',
                                ][$pemesanan->status_pemesanan] ?? 'status-diproses';
                        @endphp
                        <span class="status-badge {{ $statusClass }}">
                            {{ str_replace('_', ' ', $pemesanan->status_pemesanan) }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                    <!-- Left Column - Booking Details -->
                    <div class="md:col-span-2 space-y-6">
                        <!-- Booking Information -->
                        <section class="bg-gray-50 rounded-lg p-5" aria-labelledby="booking-info-heading">
                            <h2 id="booking-info-heading"
                                class="font-bold text-lg text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i> Informasi Pemesanan
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="text-sm text-gray-600">Kode Booking</p>
                                    <p class="font-medium">{{ $pemesanan->kode_booking ?? $pemesanan->id }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Tanggal Pemesanan</p>
                                    <p class="font-medium">{{ $pemesanan->created_at->translatedFormat('d M Y H:i') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Metode Pembayaran</p>
                                    <p class="font-medium">{{ $pemesanan->metode_pembayaran ?? 'Transfer Bank' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Pembayaran</p>
                                    <p class="font-bold text-blue-600">Rp
                                        {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- QR Code for check-in -->
                            @if ($pemesanan->status_pemesanan == 'dikonfirmasi' || $pemesanan->status_pemesanan == 'selesai')
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <h3 class="font-medium text-gray-800 mb-2">QR Code Check-in</h3>
                                    <div class="flex items-center">
                                        <div class="qr-code-container mr-4">
                                            <img src="{{ Storage::url($pemesanan->qr_code) }}"
                                                alt="QR Code untuk check-in" class="w-24 h-24" loading="lazy">
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Tunjukkan QR code ini saat check-in di
                                                homestay
                                            </p>
                                            <a href="{{ Storage::url($pemesanan->qr_code) }}"
                                                download="QRCode-WatHome-{{ $pemesanan->id }}.png"
                                                class="inline-block mt-2 text-sm text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-download mr-1"></i> Download QR Code
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </section>

                        <!-- Homestay Details -->
                        <section class="bg-gray-50 rounded-lg p-5" aria-labelledby="homestay-info-heading">
                            <h2 id="homestay-info-heading"
                                class="font-bold text-lg text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-home text-blue-500 mr-2"></i> Informasi Homestay
                            </h2>

                            <div class="flex flex-col md:flex-row">
                                <img src="data:image/jpeg;base64,{{ base64_encode($pemesanan->homestay->foto) }}"
                                    alt="{{ $pemesanan->homestay->nama }}"
                                    class="w-full md:w-1/3 h-auto rounded-lg object-cover mb-4 md:mb-0 md:mr-4"
                                    loading="lazy">
                                <div>
                                    <h3 class="font-bold text-gray-800">{{ $pemesanan->homestay->nama }}</h3>
                                    <p class="text-gray-600 mb-2">{{ $pemesanan->homestay->alamat }}</p>
                                </div>
                            </div>
                        </section>

                        <!-- Room Details -->
                        <section class="bg-gray-50 rounded-lg p-5" aria-labelledby="room-details-heading">
                            <h2 id="room-details-heading"
                                class="font-bold text-lg text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-door-open text-blue-500 mr-2"></i> Detail Kamar
                            </h2>

                            <div class="space-y-4">
                                @foreach ($pemesanan->kamars->groupBy('tipe_kamar_id') as $tipeKamarId => $kamars)
                                    @php
                                        $tipeKamar = $kamars->first()->tipeKamar;
                                        $durasi = $pemesanan->tanggal_checkin->diffInDays($pemesanan->tanggal_checkout);
                                        $subtotal = $tipeKamar->harga * $kamars->count() * $durasi;
                                    @endphp
                                    <article class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h3 class="font-bold text-gray-800">{{ $tipeKamar->nama }}</h3>
                                                <p class="text-sm text-gray-600">{{ $kamars->count() }} Kamar</p>
                                            </div>
                                            <p class="font-medium">Rp
                                                {{ number_format($tipeKamar->harga, 0, ',', '.') }} /malam</p>
                                        </div>

                                        <div>
                                            <p class="text-sm text-gray-600 mb-1">Nomor Kamar:</p>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach ($kamars as $kamar)
                                                    <span
                                                        class="bg-gray-200 text-gray-800 text-xs px-3 py-1 rounded-full">{{ $kamar->nomor }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    </div>

                    <!-- Right Column - Timeline and Actions -->
                    <div class="space-y-6">
                        <!-- Booking Timeline -->
                        <section class="bg-gray-50 rounded-lg p-5" aria-labelledby="timeline-heading">
                            <h2 id="timeline-heading" class="font-bold text-lg text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-history text-blue-500 mr-2"></i> Status Pemesanan
                            </h2>

                            <div class="timeline">
                                <!-- Timeline Item 1: Pesanan Dibuat -->
                                <div class="timeline-item completed">
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-800">Pesanan Dibuat</p>
                                        <p class="text-gray-600">
                                            {{ $pemesanan->created_at->translatedFormat('d M Y H:i') }}</p>
                                    </div>
                                </div>

                                <!-- Timeline Item 2: Pembayaran Diverifikasi -->
                                @if ($pemesanan->status_pembayaran == 'diverifikasi')
                                    <div class="timeline-item completed">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-800">Pembayaran Diverifikasi</p>
                                            <p class="text-gray-600">
                                                {{ $pemesanan->updated_at->translatedFormat('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="timeline-item {{ $pemesanan->status_pemesanan == 'dibatalkan' ? '' : 'active' }}">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-800">Menunggu Verifikasi Pembayaran</p>
                                            @if ($pemesanan->status_pemesanan == 'dibatalkan')
                                                <p class="text-gray-600">Pesanan dibatalkan sebelum pembayaran
                                                    diverifikasi</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- Timeline Item 3: Pesanan Dikonfirmasi -->
                                @if ($pemesanan->status_pemesanan == 'dikonfirmasi' || $pemesanan->status_pemesanan == 'selesai')
                                    <div class="timeline-item completed">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-800">Pesanan Dikonfirmasi</p>
                                            <p class="text-gray-600">
                                                {{ $pemesanan->updated_at->translatedFormat('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                @elseif($pemesanan->status_pemesanan == 'dibatalkan')
                                    <div class="timeline-item">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-800">Pesanan Dibatalkan</p>
                                            <p class="text-gray-600">
                                                {{ $pemesanan->updated_at->translatedFormat('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="timeline-item">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-800">Menunggu Konfirmasi Pemilik</p>
                                            <p class="text-gray-600">Pemilik homestay akan mengkonfirmasi pesanan Anda
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Timeline Item 4: Check-in -->
                                @if ($pemesanan->status_pemesanan == 'selesai')
                                    <div class="timeline-item completed">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-800">Check-in</p>
                                            <p class="text-gray-600">
                                                {{ $pemesanan->tanggal_checkin->translatedFormat('d M Y') }} (13:00)
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="timeline-item">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-800">Check-in</p>
                                            <p class="text-gray-600">Jadwal:
                                                {{ $pemesanan->tanggal_checkin->translatedFormat('d M Y') }} (13:00)
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Timeline Item 5: Check-out -->
                                @if ($pemesanan->status_pemesanan == 'selesai')
                                    <div class="timeline-item completed">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-800">Check-out</p>
                                            <p class="text-gray-600">
                                                {{ $pemesanan->tanggal_checkout->translatedFormat('d M Y') }} (12:00)
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="timeline-item">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-800">Check-out</p>
                                            <p class="text-gray-600">Jadwal:
                                                {{ $pemesanan->tanggal_checkout->translatedFormat('d M Y') }} (12:00)
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </section>

                        <!-- Payment Information -->
                        <section class="bg-gray-50 rounded-lg p-5" aria-labelledby="payment-info-heading">
                            <h2 id="payment-info-heading"
                                class="font-bold text-lg text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-credit-card text-blue-500 mr-2"></i> Informasi Pembayaran
                            </h2>

                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status Pembayaran</span>
                                    @php
                                        $paymentStatusClass =
                                            [
                                                'menunggu_verifikasi' => 'bg-yellow-100 text-yellow-800',
                                                'diverifikasi' => 'bg-green-100 text-green-800',
                                                'ditolak' => 'bg-red-100 text-red-800',
                                            ][$pemesanan->status_pembayaran] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span
                                        class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $paymentStatusClass }}">
                                        {{ str_replace('_', ' ', $pemesanan->status_pembayaran) }}
                                    </span>
                                </div>

                                @if ($pemesanan->bukti_pembayaran)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Bukti Pembayaran</span>
                                        <a href="{{ Storage::url($pemesanan->bukti_pembayaran) }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-800 text-sm">
                                            Lihat Bukti <i class="fas fa-external-link-alt ml-1"></i>
                                        </a>
                                    </div>
                                @endif

                                <div class="flex justify-between">
                                    <span class="text-gray-600">Metode Pembayaran</span>
                                    <span
                                        class="font-medium">{{ $pemesanan->metode_pembayaran ?? 'Transfer Bank' }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Pembayaran</span>
                                    <span class="font-bold text-blue-600">Rp
                                        {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal Pembayaran</span>
                                    <span
                                        class="font-medium">{{ $pemesanan->updated_at->translatedFormat('d M Y H:i') }}</span>
                                </div>
                            </div>
                        </section>

                        <!-- Action Buttons -->
                        <section class="bg-gray-50 rounded-lg p-5" aria-labelledby="actions-heading">
                            <h2 id="actions-heading" class="font-bold text-lg text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-cog text-blue-500 mr-2"></i> Aksi
                            </h2>

                            <div class="space-y-3">
                                @if ($pemesanan->status_pemesanan == 'dikonfirmasi' || $pemesanan->status_pemesanan == 'selesai')
                                    <a href="{{ route('pemilik.pemesanan.invoice', $pemesanan->id) }}"
                                        target="_blank"
                                        class="block w-full text-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition">
                                        <i class="fas fa-file-invoice mr-2"></i> Lihat Invoice
                                    </a>
                                @endif

                                @if ($pemesanan->status_pemesanan == 'menunggu_konfirmasi')
                                    <form action="{{ route('pemilik.pemesanan.prosesBatalUser', $pemesanan->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('POST') <!-- Jika diperlukan -->
                                        <button type="button" onclick="confirmCancel(this.form)"
                                            class="block w-full text-center px-4 py-2 border border-red-300 rounded-lg text-red-700 font-medium hover:bg-red-50 transition">
                                            <i class="fas fa-times-circle mr-2"></i> Batalkan Pesanan
                                        </button>
                                    </form>
                                @endif

                                @if ($pemesanan->status_pemesanan == 'dikonfirmasi' && now()->lt($pemesanan->tanggal_checkin))
                                    <form action="{{ route('pemilik.pemesanan.checkin', $pemesanan->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <button type="button" onclick="confirmCheckin(this.form)"
                                            class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
                                            <i class="fas fa-check-circle mr-2"></i> Check-in Sekarang
                                        </button>
                                    </form>
                                @endif

                                @if (in_array($pemesanan->status_pemesanan, ['selesai', 'dibatalkan']))
                                    @if ($pemesanan->homestay && $pemesanan->homestay->pemilik && $pemesanan->homestay->pemilik->no_telepon)
                                        @php
                                            // Format nomor telepon
                                            $nomorPemilik = $pemesanan->homestay->pemilik->no_telepon;
                                            $nomorPemilik = preg_replace('/^0/', '62', $nomorPemilik);
                                            $nomorPemilik = preg_replace('/[^0-9]/', '', $nomorPemilik);

                                            // Pesan otomatis pemilik (encoded)
                                            $autoReply = urlencode(
                                                "Terima kasih telah menghubungi kami.\n\n*PENGEMBALIAN DANA*\nProses refund untuk pemesanan #" .
                                                    ($pemesanan->kode_booking ?? $pemesanan->id) .
                                                    " akan kami proses dalam 1-3 hari kerja setelah data lengkap kami terima.\n\nKami akan mengirimkan notifikasi via WhatsApp ketika dana sudah dikembalikan.\n\nTerima kasih atas pengertiannya.\n\n*Tim WatHome*",
                                            );
                                        @endphp

                                        <button
                                            onclick="openRefundWhatsApp('{{ $nomorPemilik }}', '{{ Auth::user()->name }}', '{{ $pemesanan->kode_booking ?? $pemesanan->id }}', '{{ number_format($pemesanan->total_harga, 0, ',', '.') }}', '{{ $autoReply }}')"
                                            class="block w-full text-center px-4 py-2 bg-orange-500 text-white rounded-lg font-medium hover:bg-orange-600 transition">
                                            <i class="fas fa-exchange-alt mr-2"></i> Ajukan Pengembalian
                                        </button>
                                    @else
                                        <div class="text-sm text-gray-500 p-2 bg-gray-50 rounded">
                                            Kontak pemilik tidak tersedia untuk pengajuan refund
                                        </div>
                                    @endif
                                @endif


                                <a href="{{ route('pemilik.homestays.detail', $pemesanan->homestay->id) }}"
                                    class="block w-full text-center px-4 py-2 border border-blue-300 rounded-lg text-blue-700 font-medium hover:bg-blue-50 transition">
                                    <i class="fas fa-home mr-2"></i> Lihat Homestay
                                </a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <!-- Booking Summary -->
            <section class="bg-white rounded-xl shadow-md overflow-hidden" aria-labelledby="booking-summary-heading">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 id="booking-summary-heading" class="font-bold text-lg text-gray-800">Ringkasan Pemesanan</h2>
                </div>

                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between">
                        <!-- Check-in/Check-out -->
                        <div class="mb-6 md:mb-0">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-calendar-check text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Tanggal Menginap</h3>
                                    <p class="text-gray-600">
                                        {{ $pemesanan->tanggal_checkin->translatedFormat('d M Y') }} -
                                        {{ $pemesanan->tanggal_checkout->translatedFormat('d M Y') }}
                                        ({{ $pemesanan->tanggal_checkin->diffInDays($pemesanan->tanggal_checkout) }}
                                        malam)
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <p class="text-sm text-gray-600">Check-in</p>
                                    <p class="font-medium">
                                        {{ $pemesanan->tanggal_checkin->translatedFormat('d M Y') }}</p>
                                    <p class="text-sm text-gray-600">13:00 WIB</p>
                                </div>
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <p class="text-sm text-gray-600">Check-out</p>
                                    <p class="font-medium">
                                        {{ $pemesanan->tanggal_checkout->translatedFormat('d M Y') }}</p>
                                    <p class="text-sm text-gray-600">12:00 WIB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="bg-gray-50 rounded-lg p-5 w-full md:w-1/2">
                            <h3 class="font-bold text-gray-800 mb-3">Rincian Harga</h3>

                            <div class="space-y-3">
                                @foreach ($pemesanan->kamars->groupBy('tipe_kamar_id') as $tipeKamarId => $kamars)
                                    @php
                                        $tipeKamar = $kamars->first()->tipeKamar;
                                        $durasi = $pemesanan->tanggal_checkin->diffInDays($pemesanan->tanggal_checkout);
                                        $subtotal = $tipeKamar->harga * $kamars->count() * $durasi;
                                    @endphp
                                    <div class="flex justify-between border-b border-gray-200 pb-2">
                                        <div>
                                            <p class="text-gray-800">{{ $kamars->count() }}x {{ $tipeKamar->nama }}
                                            </p>
                                            <p class="text-sm text-gray-600">{{ $durasi }} malam x
                                                Rp {{ number_format($tipeKamar->harga, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                    </div>
                                @endforeach

                                <div class="flex justify-between border-t border-gray-200 pt-3">
                                    <p class="font-bold text-gray-800">Total</p>
                                    <p class="font-bold text-blue-600">Rp
                                        {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>


    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-hotel mr-2 text-blue-400"></i> WatHome.com
                    </h3>
                    <p class="text-gray-400">Platform pemesanan penginapan terbaik di Pacitan dengan berbagai pilihan
                        homestay berkualitas.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition">Tentang
                                Kami</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-gray-400 hover:text-white transition">Kontak</a></li>
                        <li><a href="{{ route('faq') }}" class="text-gray-400 hover:text-white transition">FAQ</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Dukungan</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('privacy') }}"
                                class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('terms') }}" class="text-gray-400 hover:text-white transition">Syarat &
                                Ketentuan</a></li>
                        <li><a href="{{ route('help') }}"
                                class="text-gray-400 hover:text-white transition">Bantuan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-blue-400"></i> Jl. Pantai Teleng Ria No. 17,
                            Pacitan
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-blue-400"></i> +62 812 3456 7890
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-blue-400"></i> hello@wathome.com
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; {{ date('Y') }} WatHome.com. All rights
                    reserved.</p>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/share/167HurYZ9F/" target="_blank" rel="noopener noreferrer"
                        class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/blog_wathome" target="_blank" rel="noopener noreferrer"
                        class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/wathome.official" target="_blank" rel="noopener noreferrer"
                        class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function confirmCancel() {
            if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
                window.location.href = "{{ route('pemilik.pemesanan.prosesBatalUser', $pemesanan->id) }}";
            }
        }

        function confirmCheckin() {
            if (confirm('Apakah Anda yakin ingin melakukan check-in sekarang?')) {
                window.location.href = "{{ route('pemilik.pemesanan.checkin', $pemesanan->id) }}";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Header scroll effect
            window.addEventListener('scroll', function() {
                const header = document.querySelector('.header');
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        });

        function confirmCancel(form) {
            Swal.fire({
                title: 'Batalkan Pesanan',
                text: "Apakah Anda yakin ingin membatalkan pesanan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form yang terkait
                }
            });
        }

        function confirmCheckin(form) {
            Swal.fire({
                title: 'Check-in',
                text: "Apakah Anda yakin ingin melakukan check-in sekarang?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Check-in!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function openRefundWhatsApp(phone, name, bookingCode, amount, autoReply) {
            // Format nomor akhir
            let cleanPhone = phone.startsWith('62') ? phone : '62' + phone;
            cleanPhone = cleanPhone.replace(/[^0-9]/g, '');

            // Template pesan pengguna
            const userMessage = `Halo Admin WatHome,

Saya *${name}* ingin mengajukan pengembalian dana untuk:
• Kode Booking: *${bookingCode}*
• Total: *Rp ${amount}*

*Data Rekening Saya:*
1. Nama Bank: 
2. Nomor Rekening: 
3. Atas Nama: 
4. Nominal yang diminta: 

Saya telah melampirkan bukti pendukung.
Mohon konfirmasi penerimaan permohonan ini.

Terima kasih.`;

            // Gabungkan dengan pesan otomatis pemilik
            const fullMessage = `${userMessage}\n\n\n${decodeURIComponent(autoReply)}`;

            // Buka WhatsApp
            window.open(`https://wa.me/${cleanPhone}?text=${encodeURIComponent(fullMessage)}`, '_blank');
        }


        document.addEventListener('DOMContentLoaded', function() {
            // Header scroll effect
            window.addEventListener('scroll', function() {
                const header = document.querySelector('.header');
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        });
    </script>
</body>

</html>
