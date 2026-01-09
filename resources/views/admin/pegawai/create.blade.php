@extends('layout.admin_layout')

@section('title', 'Tambah Data Pegawai')

@section('content')

<h4 class="page-title">Tambah Data Pegawai</h4>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="card-title">Form Tambah Data Pegawai</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('pegawai.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">

                    {{-- STATUS PEGAWAI --}}
                    <div class="mb-3">
                        <label class="form-label">Status Pegawai</label>
                        <select name="status_pegawai" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="PNS" {{ old('status_pegawai') == 'PNS' ? 'selected' : '' }}>PNS</option>
                            <option value="Non PNS" {{ old('status_pegawai') == 'Non PNS' ? 'selected' : '' }}>Non PNS</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Pegawai</label>
                        <input type="text" name="nama_pegawai"
                               class="form-control"
                               value="{{ old('nama_pegawai') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="text" name="nip"
                               class="form-control"
                               value="{{ old('nip') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIP BPS</label>
                        <input type="text" name="nip_bps"
                               class="form-control"
                               value="{{ old('nip_bps') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan"
                               class="form-control"
                               value="{{ old('jabatan') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Subbagian / Seksi</label>
                        <input type="text"
                            name="subbagian"
                            class="form-control"
                            value="{{ old('subbagian') }}"
                            placeholder="Contoh: Umum, Statistik Sosial, Neraca">
                        <small class="text-muted">
                            Opsional — diisi jika pegawai memiliki subbagian/seksi
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Golongan Akhir</label>
                        <input type="text" name="golongan_akhir"
                               class="form-control"
                               value="{{ old('golongan_akhir') }}">
                    </div>

                </div>

                <div class="col-md-6">

                    {{-- FOTO --}}
                    <div class="mb-3">
                        <label class="form-label">Foto Pegawai (Opsional)</label>
                        <input type="file"
                               name="foto"
                               class="form-control"
                               accept="image/*">
                        <small class="text-muted">
                            JPG, JPEG, PNG • Maks 2MB
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pendidikan</label>
                        <input type="text" name="pendidikan"
                               class="form-control"
                               value="{{ old('pendidikan') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir"
                               class="form-control"
                               value="{{ old('tempat_lahir') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir"
                               class="form-control"
                               value="{{ old('tanggal_lahir') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Agama</label>
                        <select name="agama" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>

                </div>
            </div>

            <hr>

            {{-- AKUN LOGIN --}}
            <div class="mb-3">
                <label class="form-label">Akun Login (Opsional)</label>
                <select name="id_akun" class="form-select">
                    <option value="">Tidak terhubung</option>
                    @foreach ($akun as $a)
                        <option value="{{ $a->id_akun }}">
                            {{ $a->username }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-center">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</div>

@endsection
