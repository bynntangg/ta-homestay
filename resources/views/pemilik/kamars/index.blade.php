@extends('dashboard.pemilik')

@section('content')
<div class="container-fluid">
    <!-- Pesan Sukses atau Error -->
    @if (session('success'))
        <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Mode Create atau Edit -->
    @if ($mode === 'create' || $mode === 'edit')
        @if ($mode === 'edit' && $kamar->tipeKamar->homestay->pemilik_id != auth()->user()->id)
            <div class="card shadow mb-4">
                <div class="card-body text-center py-5">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                    <h4 class="text-gray-800">Anda tidak memiliki akses untuk mengedit kamar ini</h4>
                    <a href="{{ route('pemilik.kamars.index') }}" class="btn btn-secondary mt-3">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>
        @else
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center">
                    <h5 class="m-0 font-weight-bold text-primary">
                        <i class="fas {{ $mode === 'create' ? 'fa-plus' : 'fa-edit' }} mr-2"></i>
                        {{ $mode === 'create' ? 'Tambah Kamar' : 'Edit Kamar' }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ $mode === 'create' ? route('pemilik.kamars.store') : route('pemilik.kamars.update', $kamar->id) }}" method="POST">
                        @csrf
                        @if ($mode === 'edit')
                            @method('PUT')
                        @endif

                        <!-- Input Nomor Kamar -->
                        <div class="form-group mb-4">
                            <label for="nomor" class="font-weight-bold text-gray-800">Nomor Kamar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-door-open"></i>
                                    </span>
                                </div>
                                <input type="text" name="nomor" id="nomor" class="form-control"
                                    value="{{ $mode === 'edit' ? $kamar->nomor : old('nomor') }}" required>
                            </div>
                        </div>

                        <!-- Dropdown Ketersediaan -->
                        <div class="form-group mb-4">
                            <label for="ketersediaan" class="font-weight-bold text-gray-800">Ketersediaan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-calendar-check"></i>
                                    </span>
                                </div>
                                <select name="ketersediaan" id="ketersediaan" class="form-control" required>
                                    <option value="1" {{ ($mode === 'edit' && $kamar->ketersediaan == 1) || old('ketersediaan') == 1 ? 'selected' : '' }}>Tersedia</option>
                                    <option value="0" {{ ($mode === 'edit' && $kamar->ketersediaan == 0) || old('ketersediaan') == 0 ? 'selected' : '' }}>Tidak Tersedia</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dropdown Tipe Kamar -->
                        <div class="form-group mb-4">
                            <label for="tipe_kamar_id" class="font-weight-bold text-gray-800">Tipe Kamar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-bed"></i>
                                    </span>
                                </div>
                                <select name="tipe_kamar_id" id="tipe_kamar_id" class="form-control" required>
                                    <option value="">Pilih Tipe Kamar</option>
                                    @foreach ($tipeKamars as $tipeKamar)
                                        @if($tipeKamar->homestay->pemilik_id == auth()->user()->id)
                                            <option value="{{ $tipeKamar->id }}"
                                                {{ ($mode === 'edit' && $kamar->tipe_kamar_id == $tipeKamar->id) || old('tipe_kamar_id') == $tipeKamar->id ? 'selected' : '' }}>
                                                {{ $tipeKamar->nama }} ({{ $tipeKamar->homestay->nama }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-5">
                            @if ($mode === 'create')
                                <a href="{{ route('pemilik.kamars.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </a>
                            @else
                                <a href="{{ route('pemilik.kamars.index') }}" class="btn btn-secondary">
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
    @endif

    <!-- Mode Show -->
    @if ($mode === 'show')
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle mr-2"></i> Detail Kamar
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bg-light p-4 rounded shadow-sm mb-4">
                            <h6 class="font-weight-bold text-gray-800 border-bottom pb-2">Informasi Kamar</h6>
                            <div class="mt-3">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-door-open text-primary mr-3 fa-lg"></i>
                                    <div>
                                        <h5 class="mb-0">{{ $kamar->nomor }}</h5>
                                        <small class="text-muted">Nomor Kamar</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-calendar-check text-primary mr-3 fa-lg"></i>
                                    <div>
                                        <span class="badge {{ $kamar->ketersediaan ? 'bg-success' : 'bg-danger' }}">
                                            {{ $kamar->ketersediaan ? 'Tersedia' : 'Tidak Tersedia' }}
                                        </span>
                                        <small class="text-muted d-block">Status Ketersediaan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-4 rounded shadow-sm">
                            <h6 class="font-weight-bold text-gray-800 border-bottom pb-2">Informasi Tipe Kamar</h6>
                            <div class="mt-3">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-bed text-primary mr-3 fa-lg"></i>
                                    <div>
                                        <h5 class="mb-0">{{ $kamar->tipeKamar->nama }}</h5>
                                        <small class="text-muted">Tipe Kamar</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-home text-primary mr-3 fa-lg"></i>
                                    <div>
                                        <h5 class="mb-0">{{ $kamar->tipeKamar->homestay->nama }}</h5>
                                        <small class="text-muted">Homestay</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('pemilik.kamars.index') }}" class="btn btn-primary mr-2">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    @if($kamar->tipeKamar->homestay->pemilik_id == auth()->user()->id)
                        <a href="{{ route('pemilik.kamars.edit', $kamar->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Mode Index -->
    @if ($mode === 'index')
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-door-open mr-2"></i> Daftar Kamar
                </h5>
                <a href="{{ route('pemilik.kamars.create') }}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Kamar</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Nomor</th>
                                <th>Ketersediaan</th>
                                <th>Tipe Kamar</th>
                                <th>Homestay</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kamars as $kamar)
                                @if($kamar->tipeKamar->homestay->pemilik_id == auth()->user()->id)
                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm mr-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-door-open"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $kamar->nomor }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge {{ $kamar->ketersediaan ? 'bg-success' : 'bg-danger' }}">
                                                {{ $kamar->ketersediaan ? 'Tersedia' : 'Tidak Tersedia' }}
                                            </span>
                                        </td>
                                        <td class="align-middle">{{ $kamar->tipeKamar->nama }}</td>
                                        <td class="align-middle">{{ $kamar->tipeKamar->homestay->nama }}</td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('pemilik.kamars.show', $kamar->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('pemilik.kamars.edit', $kamar->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('pemilik.kamars.destroy', $kamar->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
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

    // Auto-hide success message after 3 seconds
    setTimeout(() => {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);
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
    }
    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }
    .btn-group .btn {
        margin-right: 5px;
        border-radius: 4px !important;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>
@endsection