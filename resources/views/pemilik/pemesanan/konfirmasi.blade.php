@extends('dashboard.pemilik')

@section('content')
    <div class="container-fluid py-4">
        <!-- Main Booking Confirmation Card -->
        <div class="card shadow-sm mb-4">
            <!-- Card Header -->
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Konfirmasi Pemesanan</h5>
                    <p class="text-muted mb-0">Kelola dan konfirmasi pemesanan dari tamu</p>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="card-body border-bottom">
                <form action="{{ route('pemilik.pemesanan.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="menunggu_konfirmasi"
                                    {{ request('status') == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi
                                </option>
                                <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>
                                    Dikonfirmasi</option>
                                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan</option>
                                <option value="check_in" {{ request('status') == 'check_in' ? 'selected' : '' }}>Check In
                                </option>
                                <option value="check_out" {{ request('status') == 'check_out' ? 'selected' : '' }}>Check Out
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter me-2"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Booking List -->
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">ID Pemesanan</th>
                            <th scope="col">Tamu</th>
                            <th scope="col">Homestay</th>
                            <th scope="col">Check-in / Check-out</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pemesanans as $pemesanan)
                            <tr>
                                <td>
                                    <div class="fw-bold">#{{ $pemesanan->id }}</div>
                                    <small
                                        class="text-muted">{{ $pemesanan->tanggal_pemesanan->format('d M Y H:i') }}</small>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $pemesanan->user->name }}</div>
                                    <small class="text-muted">{{ $pemesanan->user->email }}</small>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $pemesanan->homestay->nama }}</div>
                                    <small class="text-muted">
                                        {{ $pemesanan->kamars->count() }} Kamar
                                        ({{ $pemesanan->kamars->first()->tipeKamar->nama ?? '' }})
                                    </small>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $pemesanan->tanggal_checkin->format('d M Y') }} (13:00)</div>
                                    <small class="text-muted">{{ $pemesanan->tanggal_checkout->format('d M Y') }}
                                        (12:00)</small>
                                </td>
                                <td class="fw-bold">
                                    Rp{{ number_format($pemesanan->kamars->sum('pivot.harga'), 0, ',', '.') }}
                                </td>
                                <td>
                                    @php
                                        $statusClasses = [
                                            'menunggu_konfirmasi' => 'bg-warning text-dark',
                                            'dikonfirmasi' => 'bg-success text-white',
                                            'dibatalkan' => 'bg-danger text-white',
                                            'check_in' => 'bg-primary text-white',
                                            'check_out' => 'bg-info text-dark',
                                        ];
                                    @endphp
                                    <span
                                        class="badge rounded-pill {{ $statusClasses[$pemesanan->status_pemesanan] ?? 'bg-secondary' }}">
                                        {{ str_replace('_', ' ', $pemesanan->status_pemesanan) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('pemilik.pemesanan.detail', $pemesanan->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if ($pemesanan->status_pemesanan == 'menunggu_konfirmasi')
                                            <form
                                                action="{{ route('pemilik.pemesanan.prosesKonfirmasi', $pemesanan->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-outline-success">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form
                                                action="{{ route('pemilik.pemesanan.prosesBatalAdmin', $pemesanan->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($pemesanan->status_pemesanan == 'dikonfirmasi')
                                            <form action="{{ route('pemilik.pemesanan.checkin', $pemesanan->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-outline-info"
                                                    onclick="return confirm('Apakah Anda yakin ingin melakukan check-in?')">
                                                    <i class="fas fa-sign-in-alt"></i> Check-in
                                                </button>
                                            </form>
                                        @endif
                                        @if ($pemesanan->status_pemesanan == 'check_in')
                                            <form action="{{ route('pemilik.pemesanan.checkout', $pemesanan->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-calendar-times fa-2x mb-3"></i>
                                    <p>Tidak ada data pemesanan untuk homestay Anda</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            

            <!-- Pagination -->
            @if ($pemesanans->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-center">
                        {{ $pemesanans->links() }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Confirmed Orders by Homestay Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pesanan Dikonfirmasi</h5>
                    <p class="text-muted mb-0">Daftar pesanan yang sudah dikonfirmasi</p>
                </div>
            </div>

            <div class="card-body">
                @php
                    $perPage = 5;
                    $homestayIds = auth()->user()->homestays->pluck('id')->toArray();
                    $confirmedBookings = App\Models\Pemesanan::where('status_pemesanan', 'dikonfirmasi')
                        ->whereIn('homestay_id', $homestayIds)
                        ->orderBy('tanggal_checkin')
                        ->paginate($perPage, ['*'], 'confirmed_page');
                @endphp

                @if ($confirmedBookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Homestay</th>
                                    <th>Tamu</th>
                                    <th>Tanggal</th>
                                    <th>Kamar</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($confirmedBookings as $pemesanan)
                                    <tr>
                                        <td>#{{ $pemesanan->id }}</td>
                                        <td>{{ $pemesanan->homestay->nama }}</td>
                                        <td>
                                            <div>{{ $pemesanan->user->name }}</div>
                                            <small class="text-muted">{{ $pemesanan->user->email }}</small>
                                        </td>
                                        <td>
                                            <div>{{ $pemesanan->tanggal_checkin->format('d M Y') }} -
                                                {{ $pemesanan->tanggal_checkout->format('d M Y') }}</div>
                                            <small class="text-muted">{{ $pemesanan->malam }} malam</small>
                                        </td>
                                        <td>
                                            @foreach ($pemesanan->kamars as $kamar)
                                                <span class="badge bg-secondary me-1">{{ $kamar->nomor_kamar }}</span>
                                            @endforeach
                                        </td>
                                        <td class="fw-bold">Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('pemilik.pemesanan.detail', $pemesanan->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('pemilik.pemesanan.checkin', $pemesanan->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-outline-success">
                                                    <i class="fas fa-sign-in-alt"></i> Check-in
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Bootstrap Pagination -->
                    <nav aria-label="Confirmed bookings pagination">
                        <ul class="pagination justify-content-center mt-3">
                            {{-- Previous Page Link --}}
                            <li class="page-item {{ $confirmedBookings->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $confirmedBookings->previousPageUrl() }}"
                                    aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            {{-- Pagination Elements --}}
                            @foreach (range(1, $confirmedBookings->lastPage()) as $page)
                                <li class="page-item {{ $page == $confirmedBookings->currentPage() ? 'active' : '' }}">
                                    <a class="page-link"
                                        href="{{ $confirmedBookings->url($page) }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            {{-- Next Page Link --}}
                            <li class="page-item {{ !$confirmedBookings->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $confirmedBookings->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-calendar-check fa-2x mb-3"></i>
                        <p>Tidak ada pesanan yang sudah dikonfirmasi untuk homestay Anda</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Cancelled Orders Card -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pesanan Dibatalkan</h5>
                    <p class="text-muted mb-0">Daftar pesanan yang dibatalkan</p>
                </div>
            </div>

            <div class="card-body">
                @php
                    $cancelledBookings = App\Models\Pemesanan::where('status_pemesanan', 'dibatalkan')
                        ->whereIn('homestay_id', $homestayIds)
                        ->orderBy('updated_at', 'desc')
                        ->paginate(5, ['*'], 'cancelled_page');
                @endphp

                @if ($cancelledBookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Homestay</th>
                                    <th>Tamu</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Tanggal Check-in</th>
                                    <th>Alasan Pembatalan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cancelledBookings as $pemesanan)
                                    <tr>
                                        <td>#{{ $pemesanan->id }}</td>
                                        <td>{{ $pemesanan->homestay->nama }}</td>
                                        <td>
                                            <div>{{ $pemesanan->user->name }}</div>
                                            <small class="text-muted">{{ $pemesanan->user->email }}</small>
                                        </td>
                                        <td>{{ $pemesanan->tanggal_pemesanan->format('d M Y H:i') }}</td>
                                        <td>{{ $pemesanan->tanggal_checkin->format('d M Y') }}</td>
                                        <td>{{ $pemesanan->alasan_pembatalan ?? 'Tidak disebutkan' }}</td>
                                        <td class="fw-bold">Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <nav aria-label="Cancelled bookings pagination">
                        <ul class="pagination justify-content-center mt-3">
                            <li class="page-item {{ $cancelledBookings->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $cancelledBookings->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @foreach (range(1, $cancelledBookings->lastPage()) as $page)
                                <li class="page-item {{ $page == $cancelledBookings->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $cancelledBookings->url($page) }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ !$cancelledBookings->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $cancelledBookings->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-ban fa-2x mb-3"></i>
                        <p>Tidak ada pesanan yang dibatalkan</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Checked-in Orders Card -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tamu Sedang Menginap</h5>
                    <p class="text-muted mb-0">Daftar tamu yang sedang check-in</p>
                </div>
            </div>

            <div class="card-body">
                @php
                    $checkedInBookings = App\Models\Pemesanan::where('status_pemesanan', 'check_in')
                        ->whereIn('homestay_id', $homestayIds)
                        ->orderBy('tanggal_checkin')
                        ->paginate(5, ['*'], 'checkin_page');
                @endphp

                @if ($checkedInBookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Homestay</th>
                                    <th>Tamu</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Kamar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checkedInBookings as $pemesanan)
                                    <tr>
                                        <td>#{{ $pemesanan->id }}</td>
                                        <td>{{ $pemesanan->homestay->nama }}</td>
                                        <td>
                                            <div>{{ $pemesanan->user->name }}</div>
                                            <small class="text-muted">{{ $pemesanan->user->email }}</small>
                                        </td>
                                        <td>
                                            <div>{{ $pemesanan->tanggal_checkin->format('d M Y') }}</div>
                                            <small class="text-muted">{{ $pemesanan->waktu_checkin ?? '13:00' }}</small>
                                        </td>
                                        <td>
                                            <div>{{ $pemesanan->tanggal_checkout->format('d M Y') }}</div>
                                            <small class="text-muted">12:00</small>
                                        </td>
                                        <td>
                                            @foreach ($pemesanan->kamars as $kamar)
                                                <span class="badge bg-primary me-1">{{ $kamar->nomor_kamar }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <form action="{{ route('pemilik.pemesanan.checkout', $pemesanan->id) }}" method="POST">
                                                @csrf
                                                @method('PUT') <!-- Karena controller menggunakan method PUT -->
                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('Apakah Anda yakin ingin melakukan check-out?')">
                                                    <i class="fas fa-sign-out-alt"></i> Check-out
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <nav aria-label="Checked-in bookings pagination">
                        <ul class="pagination justify-content-center mt-3">
                            <li class="page-item {{ $checkedInBookings->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $checkedInBookings->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @foreach (range(1, $checkedInBookings->lastPage()) as $page)
                                <li class="page-item {{ $page == $checkedInBookings->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $checkedInBookings->url($page) }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ !$checkedInBookings->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $checkedInBookings->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-bed fa-2x mb-3"></i>
                        <p>Tidak ada tamu yang sedang menginap</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Checked-out Orders Card -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Riwayat Check-out</h5>
                    <p class="text-muted mb-0">Daftar tamu yang sudah check-out</p>
                </div>
            </div>

            <div class="card-body">
                @php
                    $checkedOutBookings = App\Models\Pemesanan::where('status_pemesanan', 'check_out')
                        ->whereIn('homestay_id', $homestayIds)
                        ->orderBy('updated_at', 'desc')
                        ->paginate(5, ['*'], 'checkout_page');
                @endphp

                @if ($checkedOutBookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Homestay</th>
                                    <th>Tamu</th>
                                    <th>Tanggal Menginap</th>
                                    <th>Check-out</th>
                                    <th>Kamar</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checkedOutBookings as $pemesanan)
                                    <tr>
                                        <td>#{{ $pemesanan->id }}</td>
                                        <td>{{ $pemesanan->homestay->nama }}</td>
                                        <td>
                                            <div>{{ $pemesanan->user->name }}</div>
                                            <small class="text-muted">{{ $pemesanan->user->email }}</small>
                                        </td>
                                        <td>
                                            <div>{{ $pemesanan->tanggal_checkin->format('d M Y') }} - {{ $pemesanan->tanggal_checkout->format('d M Y') }}</div>
                                            <small class="text-muted">{{ $pemesanan->malam }} malam</small>
                                        </td>
                                        <td>
                                            <div>{{ $pemesanan->updated_at->format('d M Y') }}</div>
                                            <small class="text-muted">{{ $pemesanan->updated_at->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            @foreach ($pemesanan->kamars as $kamar)
                                                <span class="badge bg-secondary me-1">{{ $kamar->nomor_kamar }}</span>
                                            @endforeach
                                        </td>
                                        <td class="fw-bold">Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('pemilik.pemesanan.detail', $pemesanan->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <nav aria-label="Checked-out bookings pagination">
                        <ul class="pagination justify-content-center mt-3">
                            <li class="page-item {{ $checkedOutBookings->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $checkedOutBookings->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @foreach (range(1, $checkedOutBookings->lastPage()) as $page)
                                <li class="page-item {{ $page == $checkedOutBookings->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $checkedOutBookings->url($page) }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ !$checkedOutBookings->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $checkedOutBookings->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-history fa-2x mb-3"></i>
                        <p>Tidak ada riwayat check-out</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
