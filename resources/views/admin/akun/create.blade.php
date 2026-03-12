@extends('layout.admin_layout')

@section('title', 'Tambah Akun')

@section('content')

<h4 class="page-title">Tambah Akun</h4>

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Form Tambah Akun</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.akun.store') }}" method="POST">
            @csrf

            {{-- USERNAME --}}
            <div class="mb-3">
                <label class="form-label">Username</label>

                <input type="text"
                       name="username"
                       class="form-control @error('username') is-invalid @enderror"
                       value="{{ old('username') }}"
                       placeholder="Masukkan username">

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
                       value="{{ old('email') }}"
                       placeholder="Masukkan email">

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            {{-- PASSWORD --}}
            <div class="mb-3">
                <label class="form-label">Password</label>

                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Masukkan password">

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            {{-- KONFIRMASI PASSWORD --}}
            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>

                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Konfirmasi password">
            </div>


            {{-- LEVEL --}}
            <div class="mb-3">
                <label class="form-label">Level Akun</label>

                <select name="level"
                        class="form-select @error('level') is-invalid @enderror">

                    <option value="">-- Pilih Level --</option>

                    <option value="admin"
                        {{ old('level') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="operator"
                        {{ old('level') == 'operator' ? 'selected' : '' }}>
                        Operator
                    </option>

                    <option value="pegawai"
                        {{ old('level') == 'pegawai' ? 'selected' : '' }}>
                        Pegawai
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
                    Simpan
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
