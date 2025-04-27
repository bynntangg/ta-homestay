@extends('dashboard.pemilik')

@section('content')
<div class="container-fluid">
    <!-- Pesan Sukses atau Error -->
    @if (session('success'))
        <div id="success-message" class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Mode Create atau Edit -->
    @if ($mode === 'create' || $mode === 'edit')
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="fas {{ $mode === 'create' ? 'fa-plus' : 'fa-edit' }} mr-2"></i>
                    {{ $mode === 'create' ? 'Tambah Tipe Kamar' : 'Edit Tipe Kamar' }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ $mode === 'create' ? route('pemilik.tipe_kamar.store') : route('pemilik.tipe_kamar.update', $tipeKamar->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($mode === 'edit')
                        @method('PUT')
                    @endif

                    <!-- Dropdown untuk Homestay -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-800">Homestay</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-home"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" value="{{ $mode === 'create' ? $homestay->nama : $tipeKamar->homestay->nama }}" readonly>
                            <input type="hidden" name="homestay_id" value="{{ $mode === 'create' ? $homestay->id : $tipeKamar->homestay->id }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="nama" class="font-weight-bold text-gray-800">Nama Tipe Kamar</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $mode === 'edit' ? $tipeKamar->nama : old('nama') }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="deskripsi" class="font-weight-bold text-gray-800">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ $mode === 'edit' ? $tipeKamar->deskripsi : old('deskripsi') }}</textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label for="harga" class="font-weight-bold text-gray-800">Harga</label>
                        <select name="harga" id="harga" class="form-control" required>
                            <option value="">Pilih Tingkatan Harga</option>
                            <option value="300000" {{ ($mode === 'edit' && $tipeKamar->harga == 300000) || old('harga') == 300000 ? 'selected' : '' }}>
                                Standar: Rp 300.000
                            </option>
                            <option value="600000" {{ ($mode === 'edit' && $tipeKamar->harga == 600000) || old('harga') == 600000 ? 'selected' : '' }}>
                                Premium: Rp 600.000
                            </option>
                            <option value="1000000" {{ ($mode === 'edit' && $tipeKamar->harga == 1000000) || old('harga') == 1000000 ? 'selected' : '' }}>
                                Platinum: Rp 1.000.000
                            </option>
                            <option value="1500000" {{ ($mode === 'edit' && $tipeKamar->harga == 1500000) || old('harga') == 1500000 ? 'selected' : '' }}>
                                VVIP: Rp 1.500.000
                            </option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="foto" class="font-weight-bold text-gray-800">Foto Kamar</label>
                        <div class="custom-file">
                            <input type="file" name="foto" id="foto" class="custom-file-input">
                            <label class="custom-file-label" for="foto">Pilih file gambar...</label>
                        </div>
                        @if ($mode === 'edit' && $tipeKamar->foto)
                            @php
                                $base64 = base64_encode($tipeKamar->foto);
                                $imageSrc = 'data:image/jpeg;base64,' . $base64;
                            @endphp
                            <div class="mt-3 text-center">
                                <img src="{{ $imageSrc }}" class="img-thumbnail shadow" width="250" alt="{{ $tipeKamar->nama }}">
                                <p class="text-muted small mt-2">Foto saat ini</p>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        @if ($mode === 'create')
                            <a href="{{ route('pemilik.tipe_kamar.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </a>
                        @else
                            <a href="{{ route('pemilik.tipe_kamar.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i> Batal
                            </a>
                        @endif
                        <button type="submit" class="btn btn-primary">
                            <i class="fas {{ $mode === 'create' ? 'fa-save' : 'fa-sync-alt' }} mr-2"></i>
                            {{ $mode === 'create' ? 'Simpan' : 'Perbarui' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if ($mode === 'show')
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle mr-2"></i> Detail Tipe Kamar
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bg-light p-4 rounded shadow-sm mb-4">
                            <h6 class="font-weight-bold text-gray-800 border-bottom pb-2">Informasi Kamar</h6>
                            <div class="mt-3">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-home text-primary mr-3 fa-lg"></i>
                                    <div>
                                        <h5 class="mb-0">{{ $tipeKamar->homestay->nama }}</h5>
                                        <small class="text-muted">Homestay Terkait</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-tag text-primary mr-3 fa-lg"></i>
                                    <div>
                                        <h5 class="mb-0">{{ $tipeKamar->nama }}</h5>
                                        <small class="text-muted">Nama Tipe Kamar</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-money-bill-wave text-primary mr-3 fa-lg"></i>
                                    <div>
                                        <h5 class="mb-0">Rp {{ number_format($tipeKamar->harga, 0, ',', '.') }}</h5>
                                        <small class="text-muted">Harga per Malam</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-4 rounded shadow-sm">
                            <h6 class="font-weight-bold text-gray-800 border-bottom pb-2">Deskripsi & Foto</h6>
                            <div class="mt-3">
                                <p class="text-justify">{{ $tipeKamar->deskripsi }}</p>
                            </div>
                            <div class="text-center mt-4">
                                @if ($tipeKamar->foto)
                                    @php
                                        $base64 = base64_encode($tipeKamar->foto);
                                        $imageSrc = 'data:image/jpeg;base64,' . $base64;
                                    @endphp
                                    <img src="{{ $imageSrc }}" class="img-fluid rounded shadow" style="max-height: 250px;" alt="{{ $tipeKamar->nama }}">
                                @else
                                    <div class="alert alert-warning">Tidak ada foto tersedia</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('pemilik.tipe_kamar.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    @endif

    @if ($mode === 'index')
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-bed mr-2"></i> Daftar Tipe Kamar
                </h5>
                <a href="{{ route('pemilik.tipe_kamar.create') }}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Tipe Kamar</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Nama</th>
                                <th>Homestay</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Foto</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipeKamars as $tipeKamar)
                                <tr>
                                    <td class="align-middle font-weight-bold">{{ $tipeKamar->nama }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm mr-3">
                                                <span class="avatar-title rounded-circle bg-primary text-white">
                                                    {{ substr($tipeKamar->homestay->nama, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $tipeKamar->homestay->nama }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ Str::limit($tipeKamar->deskripsi, 50) }}</td>
                                    <td class="align-middle">Rp {{ number_format($tipeKamar->harga, 0, ',', '.') }}</td>
                                    <td class="align-middle">
                                        @if ($tipeKamar->foto)
                                            @php
                                                $base64 = base64_encode($tipeKamar->foto);
                                                $imageSrc = 'data:image/jpeg;base64,' . $base64;
                                            @endphp
                                            <img src="{{ $imageSrc }}" class="img-thumbnail" width="100" alt="Foto Kamar" data-toggle="tooltip" data-placement="top" title="Lihat Gambar">
                                        @else
                                            <span class="badge badge-warning">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pemilik.tipe_kamar.show', $tipeKamar->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('pemilik.tipe_kamar.edit', $tipeKamar->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pemilik.tipe_kamar.destroy', $tipeKamar->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus tipe kamar ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    // Enable tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    // Update custom file input label
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Auto-dismiss success message after 5 seconds
    setTimeout(function() {
        $('#success-message').fadeOut('slow');
    }, 5000);
</script>
@endpush

<style>
    .avatar-sm {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: bold;
    }
    .avatar-title {
        display: block;
        width: 100%;
        text-align: center;
    }
    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }
    .img-thumbnail {
        transition: transform 0.3s ease;
    }
    .img-thumbnail:hover {
        transform: scale(1.05);
        cursor: pointer;
    }
    .btn-group .btn {
        margin-right: 5px;
        border-radius: 4px !important;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
</style>
@endsection