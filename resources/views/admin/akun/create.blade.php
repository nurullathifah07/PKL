@extends('layout.admin_layout')

@section('title', 'Tambah Akun')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Form Tambah Akun</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('akun.store') }}" method="POST">
            @csrf <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
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
                <label for="level" class="form-label">Level Akun</label>
                <select class="form-select" id="level" name="level" required>
                    <option value="" selected disabled>Pilih Level</option>
                    <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="operator" {{ old('level') == 'operator' ? 'selected' : '' }}>Operator</option>
                    <option value="pegawai" {{ old('level') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                    </select>
                @error('level')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('akun.index') }}" class="btn btn-secondary">Batal</a>
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
