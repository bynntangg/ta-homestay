@extends('dashboard.pemilik')

@section('content')
    <div class="container">
        <!-- Pesan Sukses atau Error -->
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

        <!-- Mode Create atau Edit -->
        @if ($mode === 'create' || $mode === 'edit')
            <h2>{{ $mode === 'create' ? 'Tambah Tipe Kamar' : 'Edit Tipe Kamar' }}</h2>
            <form
                action="{{ $mode === 'create' ? route('pemilik.tipe_kamar.store') : route('pemilik.tipe_kamar.update', $tipeKamar->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if ($mode === 'edit')
                    @method('PUT')
                @endif

                <!-- Dropdown untuk Homestay -->
                <div class="form-group mb-3">
                    <label for="homestay_id">Homestay</label>
                    <select name="homestay_id" id="homestay_id" class="form-control" required>
                        <option value="">Pilih Homestay</option>
                        @foreach ($homestays as $homestay)
                            <option value="{{ $homestay->id }}"
                                {{ ($mode === 'edit' && $tipeKamar->homestay_id == $homestay->id) || old('homestay_id') == $homestay->id ? 'selected' : '' }}>
                                {{ $homestay->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control"
                        value="{{ $mode === 'edit' ? $tipeKamar->nama : old('nama') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ $mode === 'edit' ? $tipeKamar->deskripsi : old('deskripsi') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="harga">Harga</label>
                    <select name="harga" id="harga" class="form-control" required>
                        <option value="">Pilih Tingkatan Harga</option>
                        <option value="300000"
                            {{ ($mode === 'edit' && $tipeKamar->harga == 300000) || old('harga') == 300000 ? 'selected' : '' }}>
                            Standar: Rp 300.000</option>
                        <option value="600000"
                            {{ ($mode === 'edit' && $tipeKamar->harga == 600000) || old('harga') == 600000 ? 'selected' : '' }}>
                            Premium: Rp 600.000</option>
                        <option value="1000000"
                            {{ ($mode === 'edit' && $tipeKamar->harga == 1000000) || old('harga') == 1000000 ? 'selected' : '' }}>
                            VVIP: Rp 1.000.000</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                    @if ($mode === 'edit' && $tipeKamar->foto)
                        @php
                            $base64 = base64_encode($tipeKamar->foto); // Konversi binary ke Base64
                            $imageSrc = 'data:image/jpeg;base64,' . $base64; // Buat src untuk tag <img>
                        @endphp
                        <img src="{{ $imageSrc }}" width="100" class="mt-2" alt="{{ $tipeKamar->nama }}">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">{{ $mode === 'create' ? 'Simpan' : 'Update' }}</button>

                <!-- Tombol Back untuk Mode Create -->
                @if ($mode === 'create')
                    <a href="{{ route('pemilik.tipe_kamar.index') }}" class="btn btn-secondary">Kembali</a>
                @endif

                <!-- Tombol Batal untuk Mode Edit -->
                @if ($mode === 'edit')
                    <a href="{{ route('pemilik.tipe_kamar.index') }}" class="btn btn-secondary">Batal</a>
                @endif
            </form>
        @endif

        @if ($mode === 'show')
            <h2>Detail Tipe Kamar</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $tipeKamar->nama }}</h5>
                    <p class="card-text"><strong>Homestay:</strong> {{ $tipeKamar->homestay->nama }}</p>
                    <p class="card-text"><strong>Deskripsi:</strong> {{ $tipeKamar->deskripsi }}</p>
                    <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($tipeKamar->harga, 0, ',', '.') }}</p>
                    <p class="card-text"><strong>Foto:</strong></p>

                    <!-- Foto Tipe Kamar dalam Tabel -->
                    <div class="w-6 h-6">
                        @if ($tipeKamar->foto)
                            @php
                                $base64 = base64_encode($tipeKamar->foto);
                                $imageSrc = 'data:image/jpeg;base64,' . $base64;
                            @endphp
                            <img src="{{ $imageSrc }}" 
                                 alt="{{ $tipeKamar->nama }}"
                                 width="100" 
                                 height="100">
                        @else
                            <div class="w-6 h-6 bg-gray-200 flex items-center justify-center rounded-md text-xs">
                                Tidak ada foto
                            </div>
                        @endif
                    </div>
                    <a href="{{ route('pemilik.tipe_kamar.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        @endif

        @if ($mode === 'index')
            <h2>Daftar Tipe Kamar</h2>
            <a href="{{ route('pemilik.tipe_kamar.create') }}" class="btn btn-primary mb-3">Tambah Tipe Kamar</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Homestay</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipeKamars as $tipeKamar)
                        <tr>
                            <td>{{ $tipeKamar->nama }}</td>
                            <td>{{ $tipeKamar->homestay->nama }}</td>
                            <td>{{ Str::limit($tipeKamar->deskripsi, 50) }}</td>
                            <td>Rp {{ number_format($tipeKamar->harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="w-6 h-6">
                                    @if ($tipeKamar->foto)
                                        @php
                                            $base64 = base64_encode($tipeKamar->foto);
                                            $imageSrc = 'data:image/jpeg;base64,' . $base64;
                                        @endphp
                                        <img src="{{ $imageSrc }}" 
                                             alt="{{ $tipeKamar->nama }}"
                                             width="100" 
                                             height="100">
                                    @else
                                        <div class="w-6 h-6 bg-gray-200 flex items-center justify-center rounded-md text-xs">
                                            Tidak ada foto
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('pemilik.tipe_kamar.edit', $tipeKamar->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pemilik.tipe_kamar.destroy', $tipeKamar->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                <a href="{{ route('pemilik.tipe_kamar.show', $tipeKamar->id) }}"
                                    class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Script untuk Konfirmasi Hapus -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            });
        });
    </script>
@endsection
