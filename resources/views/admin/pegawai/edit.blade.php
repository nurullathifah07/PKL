@extends('layout.admin_layout')

@section('title', 'Edit Data Pegawai')

@section('content')

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Edit Data Pegawai</h4>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">

                    {{-- TAMPILKAN ERROR VALIDASI --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.pegawai.update', $pegawai->id_pegawai) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- 🔴 WAJIB: ID AKUN --}}
                        <input type="hidden" name="id_akun" value="{{ $pegawai->id_akun }}">

                        <div class="row">

                            <div class="col-md-6">

                                {{-- STATUS PEGAWAI --}}
                                <div class="mb-3">
                                    <label class="form-label">Status Pegawai</label>
                                    <select name="status_pegawai" id="status_pegawai" class="form-select" required>
                                        <option value="">Pilih Status</option>
                                        <option value="PNS"
                                            {{ old('status_pegawai', $pegawai->status_pegawai) == 'PNS' ? 'selected' : '' }}>
                                            PNS
                                        </option>
                                        <option value="Non PNS"
                                            {{ old('status_pegawai', $pegawai->status_pegawai) == 'Non PNS' ? 'selected' : '' }}>
                                            Non PNS
                                        </option>
                                    </select>
                                </div>

                                {{-- NIP --}}
                                <div class="mb-3">
                                    <label class="form-label">NIP</label>
                                    <input type="text" class="form-control"
                                           name="nip" id="nip"
                                           value="{{ old('nip', $pegawai->nip) }}">
                                    <small class="text-muted">Wajib diisi jika status PNS</small>
                                </div>

                                {{-- NIP BPS --}}
                                <div class="mb-3">
                                    <label class="form-label">NIP BPS</label>
                                    <input type="text" class="form-control"
                                           name="nip_bps" id="nip_bps"
                                           value="{{ old('nip_bps', $pegawai->nip_bps) }}">
                                    <small class="text-muted">Wajib diisi jika status PNS</small>
                                </div>

                                {{-- NAMA --}}
                                <div class="mb-3">
                                    <label class="form-label">Nama Pegawai</label>
                                    <input type="text" class="form-control"
                                           name="nama_pegawai"
                                           value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" required>
                                </div>

                                {{-- JABATAN --}}
                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" class="form-control"
                                           name="jabatan"
                                           value="{{ old('jabatan', $pegawai->jabatan) }}" required>
                                </div>

                                {{-- SUBBAGIAN --}}
                                <div class="mb-3">
                                    <label class="form-label">Subbagian</label>
                                    <input type="text" class="form-control"
                                           name="subbagian"
                                           value="{{ old('subbagian', $pegawai->subbagian) }}">
                                </div>

                            </div>

                            <div class="col-md-6">

                                {{-- GOLONGAN --}}
                                <div class="mb-3">
                                    <label class="form-label">Golongan Akhir</label>
                                    <input type="text" class="form-control"
                                           name="golongan_akhir"
                                           value="{{ old('golongan_akhir', $pegawai->golongan_akhir) }}">
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
                                           value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}">
                                </div>

                                {{-- TANGGAL LAHIR --}}
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control"
                                           name="tanggal_lahir"
                                           value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}">
                                </div>

                                {{-- JENIS KELAMIN --}}
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select">
                                        <option value="L" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>
                                        <option value="P" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                    </select>
                                </div>

                                {{-- AGAMA --}}
                                <div class="mb-3">
                                    <label class="form-label">Agama</label>
                                    <input type="text" class="form-control"
                                           name="agama"
                                           value="{{ old('agama', $pegawai->agama) }}">
                                </div>

                                {{-- FOTO --}}
                                <div class="mb-3">
                                    <label class="form-label d-block">Foto</label>

                                    @if ($pegawai->foto)
                                        <img src="{{ asset('storage/'.$pegawai->foto) }}"
                                             width="120" class="mb-2 rounded">
                                    @endif

                                    <input type="file" class="form-control" name="foto">
                                </div>

                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.pegawai.index') }}" class="btn btn-secondary">Batal</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT TOGGLE NIP --}}
<script>
    function toggleNIP() {
        const status = document.getElementById('status_pegawai').value;
        document.getElementById('nip').required = status === 'PNS';
        document.getElementById('nip_bps').required = status === 'PNS';
    }

    document.getElementById('status_pegawai').addEventListener('change', toggleNIP);
    toggleNIP();
</script>

@endsection
