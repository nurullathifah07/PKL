@extends('layout.admin_layout')

@section('title', 'Edit Daftar Pegawai')

@section('content')

<h4 class="page-title">Edit Data Pegawai</h4>
<hr>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="card-title">Form Edit Data Pegawai</h5>
    </div>
    <div class="card-body">

        <form action="{{ route('admin.pegawai') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">

                    {{-- 1. NAMA PEGAWAI --}}
                    <div class="mb-3">
                        <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" value="{{ old('nama_pegawai') }}" placeholder="Masukkan Nama Lengkap Pegawai" required>
                        @error('nama_pegawai')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 2. NIP --}}
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}" placeholder="Contoh: 198407192009012008" required>
                        @error('nip')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 3. NIP BPS (Kolom Baru) --}}
                    <div class="mb-3">
                        <label for="nip_bps" class="form-label">NIP BPS</label>
                        <input type="text" class="form-control" id="nip_bps" name="nip_bps" value="{{ old('nip_bps') }}" placeholder="Contoh: 340052319">
                        @error('nip_bps')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 4. JABATAN (Kolom Baru - Menggantikan Subbagian) --}}
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" placeholder="Contoh: Statistisi Mahir BPS Kabupaten/Kota" required>
                        @error('jabatan')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 5. GOLONGAN AKHIR (Kolom Baru) --}}
                    <div class="mb-3">
                        <label for="golongan_akhir" class="form-label">Golongan Akhir</label>
                        <input type="text" class="form-control" id="golongan_akhir" name="golongan_akhir" value="{{ old('golongan_akhir') }}" placeholder="Contoh: III/b">
                        @error('golongan_akhir')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="col-md-6">

                    {{-- 6. PENDIDIKAN (Kolom Baru) --}}
                    <div class="mb-3">
                        <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                        <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}" placeholder="Contoh: S-1 Akuntansi">
                        @error('pendidikan')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 7. TEMPAT LAHIR (Kolom Baru) --}}
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Contoh: Martapura" required>
                        @error('tempat_lahir')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 8. TANGGAL LAHIR (Kolom Baru) --}}
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        @error('tanggal_lahir')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 9. JENIS KELAMIN (Kolom Baru - Dropdown) --}}
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="LK" {{ old('jenis_kelamin') == 'LK' ? 'selected' : '' }}>Laki-laki (LK)</option>
                            <option value="PR" {{ old('jenis_kelamin') == 'PR' ? 'selected' : '' }}>Perempuan (PR)</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 10. AGAMA (Kolom Baru - Dropdown) --}}
                    <div class="mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <select class="form-select" id="agama" name="agama" required>
                            <option value="" disabled selected>Pilih Agama</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <hr>

            {{-- Bagian Opsional Akun Login --}}
            <div class="mb-4">
                <h6 class="text-primary">Pengaturan Akun Login (Opsional)</h6>
                <div class="mb-3">
                    <label for="id_akun" class="form-label">Akun Login</label>
                    <select class="form-select" id="id_akun" name="id_akun">
                        <option value="" selected>Tidak Terhubung ke Akun Login</option>
                        {{-- LOOPING DATA AKUN DARI CONTROLLER --}}
                        {{-- @foreach($accounts as $account)
                            <option value="{{ $account->id }}" {{ old('id_akun') == $account->id ? 'selected' : '' }}>{{ $account->username }} ({{ $account->role }})</option>
                        @endforeach --}}

                        {{-- Contoh data statis jika belum terhubung database --}}
                        <option value="1">Hizrian (Administrator)</option>
                        <option value="2">mark_otto (User Biasa)</option>
                    </select>
                    <small class="form-text text-muted">Hanya pilih jika pegawai ini sudah memiliki akun untuk login ke sistem.</small>
                    @error('id_akun')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary me-2">Update</button>
                <a href="{{ route('admin.pegawai') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
