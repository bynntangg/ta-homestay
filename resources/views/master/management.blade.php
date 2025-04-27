@extends('dashboard.master')

@section('title', 'Dashboard Master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard Master</h1>
        </div>

        <!-- Statistik Cards -->
        <div class="row">
            <!-- Total Homestay -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Homestay</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalHomestays }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-home fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <!-- Progress Bar Visualization -->
                        <div class="mt-2">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" role="progressbar" 
                                     style="width: {{ ($totalHomestays/max(1,$totalHomestays+$totalKamars+$tipeKamarsCount+$totalPemesanans))*100 }}%" 
                                     aria-valuenow="{{ $totalHomestays }}" aria-valuemin="0" 
                                     aria-valuemax="{{ max(1,$totalHomestays+$totalKamars+$tipeKamarsCount+$totalPemesanans) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Kamar -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Kamar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalKamars }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-door-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <!-- Progress Bar Visualization -->
                        <div class="mt-2">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" 
                                     style="width: {{ ($totalKamars/max(1,$totalHomestays+$totalKamars+$tipeKamarsCount+$totalPemesanans))*100 }}%" 
                                     aria-valuenow="{{ $totalKamars }}" aria-valuemin="0" 
                                     aria-valuemax="{{ max(1,$totalHomestays+$totalKamars+$tipeKamarsCount+$totalPemesanans) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tipe Kamar -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Tipe Kamar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $tipeKamarsCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bed fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <!-- Progress Bar Visualization -->
                        <div class="mt-2">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" role="progressbar" 
                                     style="width: {{ ($tipeKamarsCount/max(1,$totalHomestays+$totalKamars+$tipeKamarsCount+$totalPemesanans))*100 }}%" 
                                     aria-valuenow="{{ $tipeKamarsCount }}" aria-valuemin="0" 
                                     aria-valuemax="{{ max(1,$totalHomestays+$totalKamars+$tipeKamarsCount+$totalPemesanans) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Booking -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Booking</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalPemesanans }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <!-- Progress Bar Visualization -->
                        <div class="mt-2">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" 
                                     style="width: {{ ($totalPemesanans/max(1,$totalHomestays+$totalKamars+$tipeKamarsCount+$totalPemesanans))*100 }}%" 
                                     aria-valuenow="{{ $totalPemesanans }}" aria-valuemin="0" 
                                     aria-valuemax="{{ max(1,$totalHomestays+$totalKamars+$tipeKamarsCount+$totalPemesanans) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Ringkasan -->
        <div class="row">
            <!-- Ringkasan Homestay -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Homestay</h6>
                        <span class="badge badge-primary">Total: {{ $totalHomestays }}</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama Homestay</th>
                                        <th>Jumlah Kamar</th>
                                        <th style="width: 120px;">Distribusi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($homestays as $homestay)
                                    <tr>
                                        <td>{{ $homestay->nama }}</td>
                                        <td>{{ $homestay->kamars_count }}</td>
                                        <td>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-primary" role="progressbar" 
                                                     style="width: {{ ($homestay->kamars_count/max(1,$totalKamars))*100 }}%" 
                                                     aria-valuenow="{{ $homestay->kamars_count }}" 
                                                     aria-valuemin="0" 
                                                     aria-valuemax="{{ $totalKamars }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Bar Graph Visualization -->
                        <div class="mt-4">
                            <h6 class="text-center text-gray-600 mb-3">Distribusi Kamar per Homestay</h6>
                            <div class="bar-graph">
                                @foreach($homestays as $homestay)
                                <div class="bar-item">
                                    <div class="bar-label">{{ Str::limit($homestay->nama, 15) }}</div>
                                    <div class="bar-container">
                                        <div class="bar-fill" style="width: {{ ($homestay->kamars_count/max(1,$totalKamars))*100 }}%; background-color: #4e73df;"></div>
                                        <div class="bar-value">{{ $homestay->kamars_count }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Tipe Kamar -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Tipe Kamar</h6>
                        <span class="badge badge-primary">Total: {{ $tipeKamarsCount }}</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tipe Kamar</th>
                                        <th>Jumlah Kamar</th>
                                        <th style="width: 120px;">Distribusi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tipeKamars as $tipe)
                                    <tr>
                                        <td>{{ $tipe->nama }}</td>
                                        <td>{{ $tipe->kamars_count }}</td>
                                        <td>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-info" role="progressbar" 
                                                     style="width: {{ ($tipe->kamars_count/max(1,$totalKamars))*100 }}%" 
                                                     aria-valuenow="{{ $tipe->kamars_count }}" 
                                                     aria-valuemin="0" 
                                                     aria-valuemax="{{ $totalKamars }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Horizontal Bar Graph Visualization -->
                        <div class="mt-4">
                            <h6 class="text-center text-gray-600 mb-3">Distribusi Kamar per Tipe</h6>
                            <div class="bar-graph">
                                @foreach($tipeKamars as $tipe)
                                <div class="bar-item">
                                    <div class="bar-label">{{ Str::limit($tipe->nama, 15) }}</div>
                                    <div class="bar-container">
                                        <div class="bar-fill" style="width: {{ ($tipe->kamars_count/max(1,$totalKamars))*100 }}%; background-color: #36b9cc;"></div>
                                        <div class="bar-value">{{ $tipe->kamars_count }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comparison Section -->
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Perbandingan Data</h6>
                    </div>
                    <div class="card-body">
                        <!-- Comparison Bars -->
                        <div class="comparison-container">
                            <div class="comparison-item">
                                <div class="comparison-label">Homestay</div>
                                <div class="comparison-bar-container">
                                    <div class="comparison-bar" style="width: {{ ($totalHomestays/max($totalHomestays,$totalKamars,$tipeKamarsCount,$totalPemesanans))*100 }}%; background-color: #4e73df;"></div>
                                    <div class="comparison-value">{{ $totalHomestays }}</div>
                                </div>
                            </div>
                            <div class="comparison-item">
                                <div class="comparison-label">Kamar</div>
                                <div class="comparison-bar-container">
                                    <div class="comparison-bar" style="width: {{ ($totalKamars/max($totalHomestays,$totalKamars,$tipeKamarsCount,$totalPemesanans))*100 }}%; background-color: #1cc88a;"></div>
                                    <div class="comparison-value">{{ $totalKamars }}</div>
                                </div>
                            </div>
                            <div class="comparison-item">
                                <div class="comparison-label">Tipe Kamar</div>
                                <div class="comparison-bar-container">
                                    <div class="comparison-bar" style="width: {{ ($tipeKamarsCount/max($totalHomestays,$totalKamars,$tipeKamarsCount,$totalPemesanans))*100 }}%; background-color: #36b9cc;"></div>
                                    <div class="comparison-value">{{ $tipeKamarsCount }}</div>
                                </div>
                            </div>
                            <div class="comparison-item">
                                <div class="comparison-label">Booking</div>
                                <div class="comparison-bar-container">
                                    <div class="comparison-bar" style="width: {{ ($totalPemesanans/max($totalHomestays,$totalKamars,$tipeKamarsCount,$totalPemesanans))*100 }}%; background-color: #f6c23e;"></div>
                                    <div class="comparison-value">{{ $totalPemesanans }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Bar Graph Styles */
        .bar-graph {
            margin-top: 20px;
        }
        .bar-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .bar-label {
            width: 120px;
            font-size: 12px;
            color: #5a5c69;
            text-align: right;
            padding-right: 10px;
        }
        .bar-container {
            flex-grow: 1;
            display: flex;
            align-items: center;
            position: relative;
            height: 20px;
        }
        .bar-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 0.6s ease;
        }
        .bar-value {
            position: absolute;
            right: 5px;
            font-size: 11px;
            color: #fff;
            text-shadow: 0 0 2px #000;
        }
        
        /* Comparison Styles */
        .comparison-container {
            margin-top: 20px;
        }
        .comparison-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .comparison-label {
            width: 100px;
            font-weight: bold;
            color: #5a5c69;
        }
        .comparison-bar-container {
            flex-grow: 1;
            display: flex;
            align-items: center;
            position: relative;
            height: 25px;
            background-color: #f8f9fc;
            border-radius: 4px;
            overflow: hidden;
        }
        .comparison-bar {
            height: 100%;
            transition: width 0.6s ease;
        }
        .comparison-value {
            position: absolute;
            right: 10px;
            font-size: 12px;
            font-weight: bold;
            color: #5a5c69;
        }
    </style>
@endsection