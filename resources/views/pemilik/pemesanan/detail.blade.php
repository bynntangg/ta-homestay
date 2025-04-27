@extends('dashboard.pemilik')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h4 mb-0">Detail Pemesanan</h2>
                    <p class="text-muted mb-0">ID: {{ $pemesanan->id }}</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    @if($pemesanan->status_pemesanan == 'menunggu_konfirmasi')
                        <span class="badge bg-warning text-dark rounded-pill">
                            {{ str_replace('_', ' ', $pemesanan->status_pemesanan) }}
                        </span>
                    @elseif($pemesanan->status_pemesanan == 'dikonfirmasi')
                        <span class="badge bg-success rounded-pill">
                            {{ str_replace('_', ' ', $pemesanan->status_pemesanan) }}
                        </span>
                    @elseif($pemesanan->status_pemesanan == 'dibatalkan')
                        <span class="badge bg-danger rounded-pill">
                            {{ str_replace('_', ' ', $pemesanan->status_pemesanan) }}
                        </span>
                    @elseif($pemesanan->status_pemesanan == 'check_in')
                        <span class="badge bg-primary rounded-pill">
                            {{ str_replace('_', ' ', $pemesanan->status_pemesanan) }}
                        </span>
                    @elseif($pemesanan->status_pemesanan == 'check_out')
                        <span class="badge bg-info text-dark rounded-pill">
                            {{ str_replace('_', ' ', $pemesanan->status_pemesanan) }}
                        </span>
                    @endif
                    <a href="{{ route('pemilik.pemesanan.konfirmasi') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-8 mb-4">
                    <!-- Booking Information Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Informasi Pemesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Tanggal Pemesanan</p>
                                    <p class="mb-0">{{ $pemesanan->tanggal_pemesanan->format('d M Y H:i') }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Durasi Menginap</p>
                                    <p class="mb-0">
                                        {{ $pemesanan->tanggal_checkin->diffInDays($pemesanan->tanggal_checkout) }} Malam
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Check-in</p>
                                    <p class="mb-0">{{ $pemesanan->tanggal_checkin->format('d M Y') }} (13:00)</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Check-out</p>
                                    <p class="mb-0">{{ $pemesanan->tanggal_checkout->format('d M Y') }} (12:00)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Guest Information Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Informasi Tamu</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Nama Lengkap</p>
                                    <p class="mb-0">{{ $pemesanan->user->name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Email</p>
                                    <p class="mb-0">{{ $pemesanan->user->email }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Nomor Telepon</p>
                                    <p class="mb-0">{{ $pemesanan->user->phone ?? '-' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Tipe Identitas</p>
                                    <p class="mb-0">{{ $pemesanan->tipe_identitas }}</p>
                                </div>
                                <div class="col-12 mb-3">
                                    <p class="text-muted small mb-1">Nomor Identitas</p>
                                    <p class="mb-0">{{ $pemesanan->nomor_identitas }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Room Information Card -->
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Informasi Kamar</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Homestay</p>
                                    <p class="mb-0">{{ $pemesanan->homestay->nama }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Tipe Kamar</p>
                                    <p class="mb-0">{{ $pemesanan->kamars->first()->tipeKamar->nama }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Jumlah Kamar</p>
                                    <p class="mb-0">{{ $pemesanan->kamars->count() }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Nomor Kamar</p>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($pemesanan->kamars as $kamar)
                                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                                {{ $kamar->nomor }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <!-- Payment Information Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Informasi Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <p class="text-muted small mb-1">Metode Pembayaran</p>
                                <p class="mb-3">Transfer Bank</p>
                                
                                <p class="text-muted small mb-1">Bank Tujuan</p>
                                <p class="mb-3">{{ $pemesanan->homestay->nama_bank }}</p>
                                
                                <p class="text-muted small mb-1">Nomor Rekening</p>
                                <p class="mb-3">{{ $pemesanan->homestay->nomor_rekening }}</p>
                                
                                <p class="text-muted small mb-1">Atas Nama</p>
                                <p class="mb-3">{{ $pemesanan->homestay->atas_nama }}</p>
                            </div>
                            
                            <hr class="my-3">
                            
                            <div class="mb-2">
                                <p class="text-muted small mb-1">Harga per Kamar per Malam</p>
                                <p class="mb-3">
                                    Rp{{ number_format($pemesanan->kamars->first()->tipeKamar->harga, 0, ',', '.') }}
                                </p>
                                
                                <p class="text-muted small mb-1">Jumlah Kamar</p>
                                <p class="mb-3">{{ $pemesanan->kamars->count() }}</p>
                                
                                <p class="text-muted small mb-1">Jumlah Malam</p>
                                <p class="mb-3">
                                    {{ $pemesanan->tanggal_checkin->diffInDays($pemesanan->tanggal_checkout) }}
                                </p>
                            </div>
                            
                            <hr class="my-3">
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0 fw-bold">Total Pembayaran</p>
                                <p class="mb-0 fw-bold text-primary">
                                    Rp{{ number_format($pemesanan->kamars->sum('pivot.harga'), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Proof Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Bukti Pembayaran</h5>
                        </div>
                        <div class="card-body text-center">
                            @if($pemesanan->payment_proof)
                                <img src="{{ Storage::url($pemesanan->payment_proof) }}" 
                                     alt="Bukti Pembayaran" 
                                     class="img-fluid rounded mb-3">
                                <a href="{{ Storage::url($pemesanan->payment_proof) }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-external-link-alt me-2"></i> Lihat Full Size
                                </a>
                            @else
                                <p class="text-muted mb-0">Tidak ada bukti pembayaran yang diupload</p>
                            @endif
                        </div>
                    </div>

                    <!-- QR Code Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">QR Code Booking</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ Storage::url($pemesanan->qr_code) }}" 
                                 alt="QR Code" 
                                 class="img-thumbnail mb-3" style="width: 200px; height: 200px;">
                            <p class="text-muted small mb-0">Scan QR code ini saat check-in</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 