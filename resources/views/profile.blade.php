@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $is_editing ?? false ? 'Edit Profil' : 'Profil Saya' }}
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @auth
                            @php
                                $currentUser = $user ?? auth()->user();
                            @endphp

                            @if (isset($is_editing) && $is_editing)
                                <!-- Mode Edit -->
                                <form method="POST" action="{{ route('profile') }}">
                                    @csrf
                                    @method('put')

                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $currentUser->name ?? '') }}" required>
                                    </div>

                                    <!-- Field lainnya dengan pola yang sama -->
                                </form>
                            @else
                                <!-- Mode Tampil -->
                                <p><strong>Nama:</strong> {{ $currentUser->name ?? 'Belum diisi' }}</p>
                                <p><strong>Email:</strong> {{ $currentUser->email ?? 'Belum diisi' }}</p>
                                <p><strong>No. Telepon:</strong> {{ $currentUser->no_telepon ?? '-' }}</p>
                            @endif
                        @else
                            <div class="alert alert-warning">
                                Silakan login untuk melihat profil
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
