@extends('layout.pegawai_layout')

@section('title','Edit Profil')

@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit Profil Pegawai
            </h6>
        </div>

        <div class="card-body">
            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Pegawai</label>
                        <input type="text" name="nama_pegawai" class="form-control"
                            value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control"
                            value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                            value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="L" {{ $pegawai->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $pegawai->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Agama</label>
                        <input type="text" name="agama" class="form-control"
                            value="{{ old('agama', $pegawai->agama) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Pendidikan</label>
                        <input type="text" name="pendidikan" class="form-control"
                            value="{{ old('pendidikan', $pegawai->pendidikan) }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control">

                        @if ($pegawai->foto)
                            <img src="{{ asset('storage/' . $pegawai->foto) }}"
                                class="mt-2 rounded"
                                width="120">
                        @endif
                    </div>
                </div>

                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="{{ route('pegawai.dashboard') }}" class="btn btn-secondary ml-2">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
