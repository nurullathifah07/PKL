@extends('layout.admin_layout')

@section('title', 'Tambah Daftar Pegawai')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Form Tambah Data Pegawai</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.pegawai') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" value="{{ old('nama_pegawai') }}" placeholder="Masukkan Nama Lengkap Pegawai" required>
                @error('nama_pegawai')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}" placeholder="Contoh: 1998050320220301001" required>
                @error('nip')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="subbagian" class="form-label">Subbagian / Jabatan</label>
                <input type="text" class="form-control" id="subbagian" name="subbagian" value="{{ old('subbagian') }}" placeholder="Contoh: Umum, Fungsional, Keuangan" required>
                @error('subbagian')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_akun" class="form-label">Akun Login (Opsional)</label>
                <select class="form-select" id="id_akun" name="id_akun">
                    <option value="" selected>Tidak Terhubung ke Akun Login</option>
                    {{-- @foreach($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->username }} ({{ $account->role }})</option>
                    @endforeach --}}
                </select>
                <small class="form-text text-muted">Hanya pilih jika pegawai ini perlu login ke sistem.</small>
                @error('id_akun')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('admin.pegawai') }}" class="btn btn-secondary">Batal</a>
            </div>
    </div>
</div>

@endsection
