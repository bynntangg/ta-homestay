@extends('dashboard.pemilik')

@section('content')
    <div class="container-fluid">
        <!-- Header with Gradient Background -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard Manajemen Homestay</h1>
            <div class="d-none d-sm-inline-block">
                <span class="text-muted">Last updated: {{ now()->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <!-- Summary Cards - Enhanced with Hover Effects -->
        <div class="row mb-4">
            <!-- Total Bookings -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 hover-scale">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pemesanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPemesanans }}</div>
                                <div class="mt-2 text-muted text-xs">
                                    <i class="fas fa-arrow-up text-success"></i> 5.2% from last month
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-primary-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2 hover-scale">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Pendapatan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                    {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                                <div class="mt-2 text-muted text-xs">
                                    <i class="fas fa-arrow-up text-success"></i> 12.4% from last month
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-success-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmed -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2 hover-scale">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Dikonfirmasi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pemesanansDikonfirmasi }}</div>
                                <div class="mt-2 text-muted text-xs">
                                    {{ round(($pemesanansDikonfirmasi/$totalPemesanans)*100, 1) }}% of total
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-info-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 hover-scale">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Menunggu</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pemesanansMenunggu }}</div>
                                <div class="mt-2 text-muted text-xs">
                                    {{ round(($pemesanansMenunggu/$totalPemesanans)*100, 1) }}% of total
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-warning-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Check In/Out -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2 hover-scale">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Check In/Out</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $pemesanansCheckIn + $pemesanansCheckOut }}</div>
                                <div class="mt-2 text-muted text-xs">
                                    {{ $pemesanansCheckIn }} In / {{ $pemesanansCheckOut }} Out
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-key fa-2x text-secondary-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cancelled -->
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-danger shadow h-100 py-2 hover-scale">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Dibatalkan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pemesanansDibatalkan }}</div>
                                <div class="mt-2 text-muted text-xs">
                                    {{ round(($pemesanansDibatalkan/$totalPemesanans)*100, 1) }}% of total
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times-circle fa-2x text-danger-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visualization Section with Card Shadows -->
        <div class="row mb-4">
            <!-- Booking Status Visualization -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4 border-0">
                    <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between border-0">
                        <h6 class="m-0 font-weight-bold text-primary">Distribusi Status Pemesanan</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                                 aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Options:</div>
                                <a class="dropdown-item" href="#">View Details</a>
                                <a class="dropdown-item" href="#">Export Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="chart-pie pt-4 pb-2 position-relative">
                            <div class="simple-pie-chart"
                                style="display: flex; justify-content: center; align-items: center; height: 200px;">
                                <div
                                    style="
                            width: 180px; 
                            height: 180px; 
                            border-radius: 50%; 
                            background: conic-gradient(
                                #4e73df 0% {{ ($pemesanansDikonfirmasi / $totalPemesanans) * 100 }}%,
                                #f6c23e {{ ($pemesanansDikonfirmasi / $totalPemesanans) * 100 }}% {{ (($pemesanansDikonfirmasi + $pemesanansMenunggu) / $totalPemesanans) * 100 }}%,
                                #36b9cc {{ (($pemesanansDikonfirmasi + $pemesanansMenunggu) / $totalPemesanans) * 100 }}% {{ (($pemesanansDikonfirmasi + $pemesanansMenunggu + $pemesanansCheckIn + $pemesanansCheckOut) / $totalPemesanans) * 100 }}%,
                                #e74a3b {{ (($pemesanansDikonfirmasi + $pemesanansMenunggu + $pemesanansCheckIn + $pemesanansCheckOut) / $totalPemesanans) * 100 }}% 100%
                            );
                            position: relative;
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        ">
                                    <div
                                        style="
                                position: absolute;
                                width: 60%;
                                height: 60%;
                                background: white;
                                border-radius: 50%;
                                top: 20%;
                                left: 20%;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-weight: bold;
                                color: #5a5c69;
                                flex-direction: column;
                                box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
                            ">
                                        {{ $totalPemesanans }}<br><span style="font-size: 12px;">Total</span>
                                    </div>
                                </div>

                                <div style="margin-left: 30px;">
                                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                        <div
                                            style="width: 15px; height: 15px; background: #4e73df; margin-right: 10px; border-radius: 3px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);">
                                        </div>
                                        <div>Dikonfirmasi <span class="font-weight-bold">({{ $pemesanansDikonfirmasi }})</span></div>
                                    </div>
                                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                        <div
                                            style="width: 15px; height: 15px; background: #f6c23e; margin-right: 10px; border-radius: 3px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);">
                                        </div>
                                        <div>Menunggu <span class="font-weight-bold">({{ $pemesanansMenunggu }})</span></div>
                                    </div>
                                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                        <div
                                            style="width: 15px; height: 15px; background: #36b9cc; margin-right: 10px; border-radius: 3px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);">
                                        </div>
                                        <div>Check In/Out <span class="font-weight-bold">({{ $pemesanansCheckIn + $pemesanansCheckOut }})</span></div>
                                    </div>
                                    <div style="display: flex; align-items: center;">
                                        <div
                                            style="width: 15px; height: 15px; background: #e74a3b; margin-right: 10px; border-radius: 3px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);">
                                        </div>
                                        <div>Dibatalkan <span class="font-weight-bold">({{ $pemesanansDibatalkan }})</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Dikonfirmasi
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-warning"></i> Menunggu
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Check In/Out
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-danger"></i> Dibatalkan
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Stats -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4 border-0">
                    <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between border-0">
                        <h6 class="m-0 font-weight-bold text-primary">Statistik Bulanan ({{ date('Y') }})</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                                 aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Options:</div>
                                <a class="dropdown-item" href="#">View Full Report</a>
                                <a class="dropdown-item" href="#">Compare with Last Year</a>
                                <a class="dropdown-item" href="#">Export Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="nav nav-pills mb-3" id="monthlyStatsTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="revenue-tab" data-toggle="pill" href="#revenue"
                                    role="tab" aria-controls="revenue" aria-selected="true">
                                    <i class="fas fa-dollar-sign mr-1"></i> Pendapatan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="bookings-tab" data-toggle="pill" href="#bookings" role="tab"
                                    aria-controls="bookings" aria-selected="false">
                                    <i class="fas fa-calendar mr-1"></i> Pemesanan
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="monthlyStatsTabContent">
                            <div class="tab-pane fade show active" id="revenue" role="tabpanel"
                                aria-labelledby="revenue-tab">
                                <div class="chart-container" style="height: 200px; position: relative;">
                                    <div class="chart-grid"
                                        style="position: absolute; width: 100%; height: 100%; display: flex;">
                                        @php
                                            $months = [
                                                'Jan',
                                                'Feb',
                                                'Mar',
                                                'Apr',
                                                'Mei',
                                                'Jun',
                                                'Jul',
                                                'Agu',
                                                'Sep',
                                                'Okt',
                                                'Nov',
                                                'Des',
                                            ];
                                            $maxRevenue = max($monthlyRevenue) > 0 ? max($monthlyRevenue) : 1;
                                        @endphp

                                        @foreach ($months as $index => $month)
                                            <div class="chart-column"
                                                style="flex: 1; display: flex; flex-direction: column; justify-content: flex-end; align-items: center; padding: 0 5px;">
                                                <div class="chart-bar-container"
                                                    style="height: 90%; width: 100%; display: flex; flex-direction: column; justify-content: flex-end;">
                                                    <div class="chart-bar bg-success"
                                                        style="
                                                    height: {{ ($monthlyRevenue[$index] / $maxRevenue) * 80 }}%;
                                                    background: linear-gradient(to top, #1cc88a, #17a673);
                                                    border-radius: 3px 3px 0 0;
                                                    transition: height 0.5s ease;
                                                    position: relative;
                                                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                                    cursor: pointer;
                                                "
                                                        title="Rp {{ number_format($monthlyRevenue[$index], 0, ',', '.') }}"
                                                        onmouseover="this.style.background='linear-gradient(to top, #17a673, #13895c)'; this.style.transform='scaleY(1.05)'"
                                                        onmouseout="this.style.background='linear-gradient(to top, #1cc88a, #17a673)'; this.style.transform='scaleY(1)'">
                                                        <div class="chart-value"
                                                            style="position: absolute; top: -25px; width: 100%; text-align: center; font-size: 12px; color: #5a5c69; font-weight: bold;">
                                                            @if ($monthlyRevenue[$index] > 0)
                                                                Rp{{ number_format($monthlyRevenue[$index] / 1000000, 1) }}jt
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chart-label"
                                                    style="height: 10%; padding-top: 5px; font-size: 12px; font-weight: 500;">
                                                    {{ $month }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Y-axis labels -->
                                    <div
                                        style="position: absolute; left: 0; top: 0; height: 90%; width: 30px; border-right: 1px solid #e3e6f0; display: flex; flex-direction: column; justify-content: space-between;">
                                        @for ($i = 0; $i <= 4; $i++)
                                            <div
                                                style="text-align: right; padding-right: 5px; font-size: 11px; color: #5a5c69; font-weight: 500;">
                                                Rp{{ number_format((($maxRevenue / 4) * $i) / 1000000, 1) }}jt
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
                                <div class="chart-container" style="height: 200px; position: relative;">
                                    <div class="chart-grid"
                                        style="position: absolute; width: 100%; height: 100%; display: flex;">
                                        @php
                                            $maxBookings = max($monthlyBookings) > 0 ? max($monthlyBookings) : 1;
                                        @endphp

                                        @foreach ($months as $index => $month)
                                            <div class="chart-column"
                                                style="flex: 1; display: flex; flex-direction: column; justify-content: flex-end; align-items: center; padding: 0 5px;">
                                                <div class="chart-bar-container"
                                                    style="height: 90%; width: 100%; display: flex; flex-direction: column; justify-content: flex-end;">
                                                    <div class="chart-bar bg-info"
                                                        style="
                                                    height: {{ ($monthlyBookings[$index] / $maxBookings) * 80 }}%;
                                                    background: linear-gradient(to top, #36b9cc, #2c9faf);
                                                    border-radius: 3px 3px 0 0;
                                                    transition: height 0.5s ease;
                                                    position: relative;
                                                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                                    cursor: pointer;
                                                "
                                                        title="{{ $monthlyBookings[$index] }} Pemesanan"
                                                        onmouseover="this.style.background='linear-gradient(to top, #2c9faf, #258391)'; this.style.transform='scaleY(1.05)'"
                                                        onmouseout="this.style.background='linear-gradient(to top, #36b9cc, #2c9faf)'; this.style.transform='scaleY(1)'">
                                                        <div class="chart-value"
                                                            style="position: absolute; top: -25px; width: 100%; text-align: center; font-size: 12px; color: #5a5c69; font-weight: bold;">
                                                            @if ($monthlyBookings[$index] > 0)
                                                                {{ $monthlyBookings[$index] }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chart-label"
                                                    style="height: 10%; padding-top: 5px; font-size: 12px; font-weight: 500;">
                                                    {{ $month }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Y-axis labels -->
                                    <div
                                        style="position: absolute; left: 0; top: 0; height: 90%; width: 30px; border-right: 1px solid #e3e6f0; display: flex; flex-direction: column; justify-content: space-between;">
                                        @for ($i = 0; $i <= 4; $i++)
                                            <div
                                                style="text-align: right; padding-right: 5px; font-size: 11px; color: #5a5c69; font-weight: 500;">
                                                {{ round(($maxBookings / 4) * $i) }}
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders - Enhanced Table -->
        <div class="card shadow mb-4 border-0">
            <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between border-0">
                <h6 class="m-0 font-weight-bold text-primary">10 Pemesanan Terbaru</h6>
                <a href="{{ route('pemilik.management.laporan') }}" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th>Homestay</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanansTerbaru as $pemesanan)
                                <tr>
                                    <td class="font-weight-bold">#{{ $pemesanan->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm mr-2">
                                                <span class="avatar-title rounded-circle bg-primary text-white">
                                                    {{ substr($pemesanan->user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                {{ $pemesanan->user->name }}
                                                <div class="text-muted small">{{ $pemesanan->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-2">
                                                <i class="fas fa-home text-info"></i>
                                            </div>
                                            <div>{{ $pemesanan->homestay->nama }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-primary font-weight-bold">{{ $pemesanan->created_at->format('d M') }}</div>
                                        <div class="text-muted small">{{ $pemesanan->created_at->format('Y') }}</div>
                                    </td>
                                    <td class="font-weight-bold text-success">
                                        Rp {{ number_format($pemesanan->total_harga_pivot, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        @if ($pemesanan->status_pemesanan == 'dikonfirmasi')
                                            <span class="badge badge-primary py-1 px-2">
                                                <i class="fas fa-check-circle mr-1"></i> Dikonfirmasi
                                            </span>
                                        @elseif($pemesanan->status_pemesanan == 'menunggu_konfirmasi')
                                            <span class="badge badge-warning py-1 px-2">
                                                <i class="fas fa-clock mr-1"></i> Menunggu
                                            </span>
                                        @elseif($pemesanan->status_pemesanan == 'check_in')
                                            <span class="badge badge-info py-1 px-2">
                                                <i class="fas fa-key mr-1"></i> Check In
                                            </span>
                                        @elseif($pemesanan->status_pemesanan == 'check_out')
                                            <span class="badge badge-secondary py-1 px-2">
                                                <i class="fas fa-door-open mr-1"></i> Check Out
                                            </span>
                                        @elseif($pemesanan->status_pemesanan == 'dibatalkan')
                                            <span class="badge badge-danger py-1 px-2">
                                                <i class="fas fa-times-circle mr-1"></i> Dibatalkan
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary rounded-circle">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom CSS for enhanced dashboard */
        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-scale:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }
        .avatar-sm {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .avatar-title {
            font-weight: bold;
            font-size: 14px;
        }
        .text-primary-light {
            color: #b5d1ff;
        }
        .text-success-light {
            color: #b5e8d8;
        }
        .text-info-light {
            color: #b5e3e8;
        }
        .text-warning-light {
            color: #f8e3b5;
        }
        .text-secondary-light {
            color: #d5d9e0;
        }
        .text-danger-light {
            color: #f8b5b5;
        }
        .badge {
            font-size: 12px;
            font-weight: 500;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        .nav-pills .nav-link.active {
            background-color: #4e73df;
            box-shadow: 0 2px 4px rgba(78, 115, 223, 0.3);
        }
        .nav-pills .nav-link {
            font-weight: 500;
            padding: 0.35rem 1rem;
        }
    </style>
@endsection