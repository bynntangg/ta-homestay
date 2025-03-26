@extends('dashboard.pemilik')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4">{{ $mode === 'create' ? 'Tambah Homestay' : 'Edit Homestay' }}</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ $mode === 'create' ? route('pemilik.homestays.store') : route('pemilik.homestays.update', $homestay->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($mode === 'edit')
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Homestay</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $homestay->nama ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat', $homestay->alamat ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ old('deskripsi', $homestay->deskripsi ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select name="rating" id="rating" class="form-select">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating', $homestay->rating ?? 1) == $i ? 'selected' : '' }}>{{ $i }} Star</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
                @if ($mode === 'edit' && $homestay->foto)
                <img src="{{ asset('storage/homestays/' . $homestay->foto) }}" alt="Foto Homestay" class="mt-2" width="100">
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Fasilitas</label>
                <div class="d-flex flex-wrap gap-3">
                    @foreach(['wifi' => 'WiFi', 'parkir' => 'Parkir', 'ac' => 'AC', 'kolam_renang' => 'Kolam Renang', 'breakfast' => 'Breakfast', 'tv' => 'TV', 'shower' => 'Shower', 'kitchen' => 'Kitchen'] as $key => $label)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="fasilitas[{{ $key }}]" value="1" id="fasilitas_{{ $key }}" {{ old('fasilitas.' . $key, $homestay->fasilitas[$key] ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="fasilitas_{{ $key }}">{{ $label }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ $mode === 'create' ? 'Simpan' : 'Update' }}</button>
            @if ($mode === 'edit')
                <a href="{{ route('pemilik.homestays.index') }}" class="btn btn-secondary">Batal</a>
            @endif
        </form>
    </div>
</div>
@endsection