@extends('dashboard.pemilik') <!-- Jika Anda menggunakan layout -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profil Pengguna</div>

                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>No Telepon:</strong> {{ $user->no_telepon }}</p>
                    <p><strong>Role:</strong> {{ $user->role }}</p>
                    <!-- Tambahkan informasi profil lainnya sesuai kebutuhan -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection