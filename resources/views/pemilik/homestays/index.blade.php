@extends('dashboard.pemilik')

@section('content')
    <div class="container">
        <!-- Tampilkan pesan sukses atau error -->
        @if (session('success'))
            <div id="success-message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tampilkan pesan error validasi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Mode Create atau Edit -->
        @if ($mode === 'create' || $mode === 'edit')
            <h2>{{ $mode === 'create' ? 'Tambah Homestay' : 'Edit Homestay' }}</h2>
            <form
                action="{{ $mode === 'create' ? route('pemilik.homestays.store') : route('pemilik.homestays.update', $homestay->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if ($mode === 'edit')
                    @method('PUT')
                @endif

                <!-- Input Nama -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control"
                        value="{{ $mode === 'edit' ? $homestay->nama : old('nama') }}" required>
                </div>

                <!-- Input Alamat -->
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required>{{ $mode === 'edit' ? $homestay->alamat : old('alamat') }}</textarea>
                </div>

                <!-- Input Deskripsi -->
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ $mode === 'edit' ? $homestay->deskripsi : old('deskripsi') }}</textarea>
                </div>

                <!-- Input Rating -->
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select name="rating" id="rating" class="form-control" required>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}"
                                {{ ($mode === 'edit' && $homestay->rating == $i) || old('rating') == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <!-- Input Foto -->
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                    @if ($mode === 'edit' && $homestay->foto)
                        <img src="data:image/jpeg;base64,{{ base64_encode($homestay->foto) }}" alt="Foto Homestay"
                            width="100" class="mt-2">
                    @endif
                </div>

                <!-- Input Fasilitas -->
                <div class="form-group">
                    <label>Fasilitas</label>
                    <div>
                        <label>
                            <input type="checkbox" name="fasilitas[wifi]" value="1"
                                {{ ($mode === 'edit' && isset($homestay->fasilitas['wifi']) && $homestay->fasilitas['wifi']) || old('fasilitas.wifi') ? 'checked' : '' }}>
                            <i class="bi bi-wifi"></i> WiFi
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="fasilitas[parkir]" value="1"
                                {{ ($mode === 'edit' && isset($homestay->fasilitas['parkir']) && $homestay->fasilitas['parkir']) || old('fasilitas.parkir') ? 'checked' : '' }}>
                            <i class="bi bi-p-circle"></i> Parkir
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="fasilitas[ac]" value="1"
                                {{ ($mode === 'edit' && isset($homestay->fasilitas['ac']) && $homestay->fasilitas['ac']) || old('fasilitas.ac') ? 'checked' : '' }}>
                            <i class="bi bi-snow"></i> AC
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="fasilitas[kolam_renang]" value="1"
                                {{ ($mode === 'edit' && isset($homestay->fasilitas['kolam_renang']) && $homestay->fasilitas['kolam_renang']) || old('fasilitas.kolam_renang') ? 'checked' : '' }}>
                            <i class="bi bi-water"></i> Kolam Renang
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="fasilitas[breakfast]" value="1"
                                {{ ($mode === 'edit' && isset($homestay->fasilitas['breakfast']) && $homestay->fasilitas['breakfast']) || old('fasilitas.breakfast') ? 'checked' : '' }}>
                            <i class="bi bi-cup-straw"></i> Breakfast
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="fasilitas[tv]" value="1"
                                {{ ($mode === 'edit' && isset($homestay->fasilitas['tv']) && $homestay->fasilitas['tv']) || old('fasilitas.tv') ? 'checked' : '' }}>
                            <i class="bi bi-tv"></i> TV
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="fasilitas[shower]" value="1"
                                {{ ($mode === 'edit' && isset($homestay->fasilitas['shower']) && $homestay->fasilitas['shower']) || old('fasilitas.shower') ? 'checked' : '' }}>
                            <i class="bi bi-droplet"></i> Shower
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="fasilitas[kitchen]" value="1"
                                {{ ($mode === 'edit' && isset($homestay->fasilitas['kitchen']) && $homestay->fasilitas['kitchen']) || old('fasilitas.kitchen') ? 'checked' : '' }}>
                            <i class="bi bi-egg-fried"></i> Kitchen
                        </label>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">{{ $mode === 'create' ? 'Simpan' : 'Update' }}</button>
                @if ($mode === 'edit')
                    <a href="{{ route('pemilik.homestays.index') }}" class="btn btn-secondary">Batal</a>
                @endif
            </form>
        @endif

        <!-- Mode Show -->
        @if ($mode === 'show')
            <h2>Detail Homestay</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $homestay->nama }}</h5>
                    <p class="card-text"><strong>Alamat:</strong> {{ $homestay->alamat }}</p>
                    <p class="card-text"><strong>Deskripsi:</strong> {{ $homestay->deskripsi }}</p>
                    <p class="card-text"><strong>Rating:</strong>
                    <div class="flex items-center space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $homestay->rating)
                                <i class="fas fa-star text-yellow-400"></i>
                            @else
                                <i class="far fa-star text-gray-300"></i>
                            @endif
                        @endfor
                        <span class="ml-2 text-gray-600">({{ $homestay->rating }})</span>
                    </div>
                    </p>
                    <p class="card-text"><strong>Foto:</strong></p>
                    @if ($homestay->foto)
                        <img src="data:image/jpeg;base64,{{ base64_encode($homestay->foto) }}" alt="Foto Homestay"
                            width="200" class="img-fluid">
                    @else
                        <p>Tidak ada foto</p>
                    @endif
                    <p class="card-text"><strong>Fasilitas:</strong></p>
                    <ul>
                        @foreach ($homestay->fasilitas as $fasilitas => $status)
                            @if ($status)
                                <li>
                                    @if ($fasilitas === 'wifi')
                                        <i class="bi bi-wifi"></i>
                                    @elseif ($fasilitas === 'parkir')
                                        <i class="bi bi-p-circle"></i>
                                    @elseif ($fasilitas === 'ac')
                                        <i class="bi bi-snow"></i>
                                    @elseif ($fasilitas === 'kolam_renang')
                                        <i class="bi bi-water"></i>
                                    @elseif ($fasilitas === 'breakfast')
                                        <i class="bi bi-cup-straw"></i>
                                    @elseif ($fasilitas === 'tv')
                                        <i class="bi bi-tv"></i>
                                    @elseif ($fasilitas === 'shower')
                                        <i class="bi bi-droplet"></i>
                                    @elseif ($fasilitas === 'kitchen')
                                        <i class="bi bi-egg-fried"></i>
                                    @endif
                                    {{ ucfirst(str_replace('_', ' ', $fasilitas)) }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <a href="{{ route('pemilik.homestays.edit', $homestay->id) }}" class="btn btn-warning">Edit</a>
                    <form id="delete-form-{{ $homestay->id }}"
                        action="{{ route('pemilik.homestays.destroy', $homestay->id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger delete-button"
                            data-id="{{ $homestay->id }}">Hapus</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection 