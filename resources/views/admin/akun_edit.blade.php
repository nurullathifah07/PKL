@extends('layout.admin_layout')

@section('title', 'Edit Akun')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Form Edit Akun</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.akun') }}" method="POST">
            @csrf <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role Akun</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="" selected disabled>Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pegawai" {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                    <option value="operator" {{ old('role') == 'manager' ? 'selected' : '' }}>Operator</option>
                    </select>
                @error('role')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary me-2">Update</button>
                <a href="{{ route('admin.akun') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        // ...
    </script>
@endsection
