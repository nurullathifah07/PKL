@extends('layout.admin_layout')

@section('title', 'Edit Data Pegawai')

@section('content')

<h4 class="page-title">Edit Data Pegawai</h4>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="card-title">Form Edit Data Pegawai</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6">

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control"
                               name="nama_pegawai"
                               value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}"
                               required>
                    </div>

                    {{-- NIP --}}
                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-control"
                               name="nip"
                               value="{{ old('nip', $pegawai->nip) }}"
                               required>
                    </div>

                    {{-- NIP BPS --}}
                    <div class="mb-3">
                        <label class="form-label">NIP BPS</label>
                        <input type="text" class="form-control"
                               name="nip_bps"
                               value="{{ old('nip_bps', $pegawai->nip_bps) }}">
                    </div>

                    {{-- JABATAN --}}
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" class="form-control"
                               name="jabatan"
                               value="{{ old('jabatan', $pegawai->jabatan) }}"
                               required>
                    </div>

                    {{-- SUBBAGIAN --}}
                    <div class="mb-3">
                        <label class="form-label">Subbagian / Seksi</label>
                        <input type="text"
                            name="subbagian"
                            class="form-control"
                            value="{{ old('subbagian', $pegawai->subbagian) }}">
                    </div>

                    {{-- GOLONGAN --}}
                    <div class="mb-3">
                        <label class="form-label">Golongan Akhir</label>
                        <input type="text" class="form-control"
                               name="golongan_akhir"
                               value="{{ old('golongan_akhir', $pegawai->golongan_akhir) }}">
                    </div>

                </div>

                <div class="col-md-6">

                    {{-- FOTO --}}
                    <div class="mb-3">
                        <label class="form-label">Foto Pegawai</label>
                        <input type="file"
                               class="form-control"
                               name="foto"
                               accept="image/*">

                        {{-- PREVIEW FOTO LAMA --}}
                        @if ($pegawai->foto)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $pegawai->foto) }}"
                                     alt="Foto Pegawai"
                                     width="120"
                                     class="img-thumbnail">
                            </div>
                        @endif

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto
                        </small>
                    </div>

                    {{-- PENDIDIKAN --}}
                    <div class="mb-3">
                        <label class="form-label">Pendidikan</label>
                        <input type="text" class="form-control"
                               name="pendidikan"
                               value="{{ old('pendidikan', $pegawai->pendidikan) }}">
                    </div>

                    {{-- TEMPAT LAHIR --}}
                    <div class="mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control"
                               name="tempat_lahir"
                               value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}"
                               required>
                    </div>

                    {{-- TANGGAL LAHIR --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control"
                               name="tanggal_lahir"
                               value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}"
                               required>
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" required>
                            <option value="">Pilih</option>
                            <option value="L"
                                {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="P"
                                {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    {{-- AGAMA --}}
                    <div class="mb-3">
                        <label class="form-label">Agama</label>
                        <select class="form-select" name="agama" required>
                            <option value="">Pilih</option>
                            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                                <option value="{{ $agama }}"
                                    {{ old('agama', $pegawai->agama) == $agama ? 'selected' : '' }}>
                                    {{ $agama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            <hr>

            {{-- AKUN LOGIN --}}
            <div class="mb-3">
                <label class="form-label">Akun Login</label>
                <select class="form-select" name="id_akun">
                    <option value="">Tidak Terhubung</option>
                    @foreach ($akun as $a)
                        <option value="{{ $a->id_akun }}"
                            {{ old('id_akun', $pegawai->id_akun) == $a->id_akun ? 'selected' : '' }}>
                            {{ $a->username }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- BUTTON --}}
            <div class="text-center">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</div>

@endsection
