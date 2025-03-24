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
            <h2>{{ $mode === 'create' ? 'Tambah Kamar' : 'Edit Kamar' }}</h2>
            <form
                action="{{ $mode === 'create' ? route('pemilik.kamars.store') : route('pemilik.kamars.update', $kamar->id) }}"
                method="POST">
                @csrf
                @if ($mode === 'edit')
                    @method('PUT')
                @endif

                <!-- Input Nomor Kamar -->
                <div class="form-group mb-3">
                    <label for="nomor">Nomor Kamar</label>
                    <input type="text" name="nomor" id="nomor" class="form-control"
                        value="{{ $mode === 'edit' ? $kamar->nomor : old('nomor') }}" required>
                </div>

                <!-- Dropdown Ketersediaan -->
                <div class="form-group mb-3">
                    <label for="ketersediaan">Ketersediaan</label>
                    <select name="ketersediaan" id="ketersediaan" class="form-control" required>
                        <option value="1" {{ ($mode === 'edit' && $kamar->ketersediaan == 1) || old('ketersediaan') == 1 ? 'selected' : '' }}>Tersedia</option>
                        <option value="0" {{ ($mode === 'edit' && $kamar->ketersediaan == 0) || old('ketersediaan') == 0 ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                </div>

                <!-- Dropdown Tipe Kamar -->
                <div class="form-group mb-3">
                    <label for="tipe_kamar_id">Tipe Kamar</label>
                    <select name="tipe_kamar_id" id="tipe_kamar_id" class="form-control" required>
                        <option value="">Pilih Tipe Kamar</option>
                        @foreach ($tipeKamars as $tipeKamar)
                            <option value="{{ $tipeKamar->id }}"
                                {{ ($mode === 'edit' && $kamar->tipe_kamar_id == $tipeKamar->id) || old('tipe_kamar_id') == $tipeKamar->id ? 'selected' : '' }}>
                                {{ $tipeKamar->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">{{ $mode === 'create' ? 'Simpan' : 'Update' }}</button>

                <!-- Tombol Back untuk Mode Create -->
                @if ($mode === 'create')
                    <a href="{{ route('pemilik.kamars.index') }}" class="btn btn-secondary">Kembali</a>
                @endif

                <!-- Tombol Batal untuk Mode Edit -->
                @if ($mode === 'edit')
                    <a href="{{ route('pemilik.kamars.index') }}" class="btn btn-secondary">Batal</a>
                @endif
            </form>
        @endif

        <!-- Mode Show -->
        @if ($mode === 'show')
            <h2>Detail Kamar</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nomor Kamar: {{ $kamar->nomor }}</h5>
                    <p class="card-text"><strong>Ketersediaan:</strong> {{ $kamar->ketersediaan ? 'Tersedia' : 'Tidak Tersedia' }}</p>
                    <p class="card-text"><strong>Tipe Kamar:</strong> {{ $kamar->tipeKamar->nama }}</p>
                    <a href="{{ route('pemilik.kamars.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        @endif

        <!-- Mode Index -->
        @if ($mode === 'index')
            <h2>Daftar Kamar</h2>
            <a href="{{ route('pemilik.kamars.create') }}" class="btn btn-primary mb-3">Tambah Kamar</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Ketersediaan</th>
                        <th>Tipe Kamar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kamars as $kamar)
                        <tr>
                            <td>{{ $kamar->nomor }}</td>
                            <td>{{ $kamar->ketersediaan ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                            <td>{{ $kamar->tipeKamar->nama }}</td>
                            <td>
                                <a href="{{ route('pemilik.kamars.edit', $kamar->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pemilik.kamars.destroy', $kamar->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                                </form>
                                <a href="{{ route('pemilik.kamars.show', $kamar->id) }}" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Script untuk Menghilangkan Pesan Sukses setelah 3 Detik -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
    </script>
@endsection