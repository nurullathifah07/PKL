@extends('layout.admin_layout')

@section('title', 'Detail Pegawai')

@section('content')

<h4 class="page-title">Detail Data Pegawai</h4>
<hr>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Informasi Pegawai</h5>

        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary btn-sm">
            <i class="la la-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">
        <div class="row">

            {{-- KOLOM KIRI --}}
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Nama Pegawai</th>
                        <td>: {{ $pegawai->nama_pegawai }}</td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <td>: {{ $pegawai->nip }}</td>
                    </tr>
                    <tr>
                        <th>NIP BPS</th>
                        <td>: {{ $pegawai->nip_bps ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>: {{ $pegawai->jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Golongan Akhir</th>
                        <td>: {{ $pegawai->golongan_akhir }}</td>
                    </tr>
                    <tr>
                        <th>Pendidikan</th>
                        <td>: {{ $pegawai->pendidikan }}</td>
                    </tr>
                </table>
            </div>

            {{-- KOLOM KANAN --}}
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Tempat Lahir</th>
                        <td>: {{ $pegawai->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>: {{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>:
                            {{ $pegawai->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td>: {{ $pegawai->agama }}</td>
                    </tr>
                    <tr>
                        <th>Username Akun</th>
                        <td>:
                            {{ $pegawai->akun->username ?? 'Belum terhubung' }}
                        </td>
                    </tr>
                </table>
            </div>

        </div>

        <hr>

        <div class="text-center">
            <a href="{{ route('pegawai.edit', $pegawai->id_pegawai) }}"
               class="btn btn-primary">
                <i class="la la-edit"></i> Edit
            </a>

            <a href="{{ route('pegawai.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </div>
</div>

@endsection
