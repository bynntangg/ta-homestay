@extends('dashboard.pemilik')

@section('content')
<div class="container-fluid">
    @if ($mode === 'create' || $mode === 'edit')
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="fas {{ $mode === 'create' ? 'fa-plus' : 'fa-edit' }} mr-2"></i>
                    {{ $mode === 'create' ? 'Tambah Carousel' : 'Edit Carousel' }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ $mode === 'create' ? route('pemilik.carousel.store') : route('pemilik.carousel.update', $carousel->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($mode === 'edit')
                        @method('PUT')
                    @endif

                    <!-- Homestay info -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-gray-800">Homestay</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-home"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" value="{{ $homestay->nama }}" readonly>
                            <input type="hidden" name="homestay_id" value="{{ $homestay->id }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="gambar" class="font-weight-bold text-gray-800">Gambar Carousel</label>
                        <div class="custom-file">
                            <input type="file" name="gambar" id="gambar" class="custom-file-input">
                            <label class="custom-file-label" for="gambar">Pilih file gambar...</label>
                        </div>
                        @if ($mode === 'edit' && $carousel->gambar)
                            @php
                                $base64 = base64_encode($carousel->gambar);
                                $imageSrc = 'data:image/jpeg;base64,' . $base64;
                            @endphp
                            <div class="mt-3 text-center">
                                <img src="{{ $imageSrc }}" class="img-thumbnail shadow" width="250" alt="Gambar Carousel">
                                <p class="text-muted small mt-2">Gambar saat ini</p>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('pemilik.carousel.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
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
                    <i class="fas fa-info-circle mr-2"></i> Detail Carousel
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bg-light p-4 rounded shadow-sm mb-4">
                            <h6 class="font-weight-bold text-gray-800 border-bottom pb-2">Informasi Homestay</h6>
                            <div class="d-flex align-items-center mt-3">
                                <i class="fas fa-home text-primary mr-3 fa-lg"></i>
                                <div>
                                    <h5 class="mb-0">{{ $carousel->homestay->nama }}</h5>
                                    <small class="text-muted">Homestay Terkait</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-4 rounded shadow-sm">
                            <h6 class="font-weight-bold text-gray-800 border-bottom pb-2">Preview Gambar</h6>
                            <div class="text-center mt-3">
                                @php
                                    $base64 = base64_encode($carousel->gambar);
                                    $imageSrc = 'data:image/jpeg;base64,' . $base64;
                                @endphp
                                <img src="{{ $imageSrc }}" class="img-fluid rounded shadow" style="max-height: 250px;" alt="Gambar Carousel">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('pemilik.carousel.index') }}" class="btn btn-primary">
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
                    <i class="fas fa-images mr-2"></i> Daftar Carousel
                </h5>
                <a href="{{ route('pemilik.carousel.create') }}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Carousel</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Homestay</th>
                                <th>Gambar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carousels as $carousel)
                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm mr-3">
                                                <span class="avatar-title rounded-circle bg-primary text-white">
                                                    {{ substr($carousel->homestay->nama, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $carousel->homestay->nama }}</h6>
                                                <small class="text-muted">ID: {{ $carousel->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if ($carousel->gambar)
                                            @php
                                                $base64 = base64_encode($carousel->gambar);
                                                $imageSrc = 'data:image/jpeg;base64,' . $base64;
                                            @endphp
                                            <img src="{{ $imageSrc }}" class="img-thumbnail" width="100" alt="Carousel Image" data-toggle="tooltip" data-placement="top" title="Lihat Gambar">
                                        @else
                                            <span class="badge badge-warning">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pemilik.carousel.show', $carousel->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('pemilik.carousel.edit', $carousel->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pemilik.carousel.destroy', $carousel->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus carousel ini?')">
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
</style>
@endsection