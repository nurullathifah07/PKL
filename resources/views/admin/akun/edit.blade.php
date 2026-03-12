@extends('layout.admin_layout')

@section('title', 'Edit Akun')

@section('content')

<h4 class="page-title">Edit Akun</h4>

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Form Edit Akun</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.akun.update', $akun->id_akun) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- USERNAME --}}
            <div class="mb-3">
                <label class="form-label">Username</label>

                <input type="text"
                       name="username"
                       class="form-control @error('username') is-invalid @enderror"
                       value="{{ old('username', $akun->username) }}">

                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label">Email</label>

                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $akun->email) }}">

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            {{-- PASSWORD BARU --}}
            <div class="mb-3">
                <label class="form-label">Password Baru</label>

                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Kosongkan jika tidak ingin mengubah password">

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <small class="text-muted">
                    Kosongkan jika tidak ingin mengubah password
                </small>
            </div>


            {{-- KONFIRMASI PASSWORD --}}
            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>

                <input type="password"
                       name="password_confirmation"
                       class="form-control">
            </div>


            {{-- LEVEL --}}
            <div class="mb-3">
                <label class="form-label">Level Akun</label>

                <select name="level"
                        class="form-select @error('level') is-invalid @enderror">

                    <option value="admin"
                        {{ old('level', $akun->level) == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="pegawai"
                        {{ old('level', $akun->level) == 'pegawai' ? 'selected' : '' }}>
                        Pegawai
                    </option>

                    <option value="operator"
                        {{ old('level', $akun->level) == 'operator' ? 'selected' : '' }}>
                        Operator
                    </option>

                </select>

                @error('level')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            {{-- BUTTON --}}
            <div class="text-center mt-4">

                <button type="submit" class="btn btn-primary me-2">
                    Update
                </button>

                <a href="{{ route('admin.akun.index') }}"
                   class="btn btn-secondary">
                   Batal
                </a>

            </div>

        </form>

    </div>
</div>

@endsection
