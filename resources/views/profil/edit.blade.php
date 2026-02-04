@extends('layout.pegawai_layout')

@section('title','Edit Profil')

@section('content')

<div class="container-fluid">

    <h4 class="page-title mb-4">Edit Profil</h4>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- FOTO --}}
                    <div class="col-md-4 text-center">

                        @if($pegawai && $pegawai->foto)
                            <img src="{{ asset('storage/'.$pegawai->foto) }}"
                                 class="rounded-circle mb-3 shadow"
                                 style="width:160px;height:160px;object-fit:cover;">
                        @else
                            <i class="la la-user-circle text-secondary mb-3"
                               style="font-size:160px;"></i>
                        @endif

                        <input type="file" name="foto" class="form-control">
                    </div>


                    {{-- FORM DATA --}}
                    <div class="col-md-8">

                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" name="nama_pegawai"
                                   value="{{ $pegawai->nama_pegawai }}"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip"
                                   value="{{ $pegawai->nip }}"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan"
                                   value="{{ $pegawai->jabatan }}"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Subbagian</label>
                            <input type="text" name="subbagian"
                                   value="{{ $pegawai->subbagian }}"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Pendidikan</label>
                            <input type="text" name="pendidikan"
                                   value="{{ $pegawai->pendidikan }}"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Agama</label>
                            <input type="text" name="agama"
                                   value="{{ $pegawai->agama }}"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Email Akun</label>
                            <input type="email" name="email"
                                   value="{{ $akun->email }}"
                                   class="form-control">
                        </div>

                        <button class="btn btn-primary">
                            💾 Simpan Perubahan
                        </button>

                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            Batal
                        </a>

                    </div>
                </div>
            </form>

        </div>
    </div>

</div>

@endsection
