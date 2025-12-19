@extends('layout.admin_layout')

@section('title', 'Edit Akun')

@section('content')

<h4 class="page-title">Edit Akun</h4>

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Form Edit Akun</h5>
    </div>
    <div class="card-body">

        <form action="{{ route('akun.update', $akun->id_akun) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text"
                       class="form-control"
                       name="username"
                       value="{{ old('username', $akun->username) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                       class="form-control"
                       name="email"
                       value="{{ old('email', $akun->email) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password"
                       class="form-control"
                       name="password">
                <small class="text-muted">
                    Kosongkan jika tidak ingin mengubah password
                </small>
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password"
                       class="form-control"
                       name="password_confirmation">
            </div>

            <div class="mb-3">
                <label class="form-label">Level</label>
                <select class="form-select" name="level" required>
                    <option value="admin" {{ old('level', $akun->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pegawai" {{ old('level', $akun->level) == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                    <option value="operator" {{ old('level', $akun->level) == 'operator' ? 'selected' : '' }}>Operator</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('akun.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</div>

@endsection
