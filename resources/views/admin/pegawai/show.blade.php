@extends('layout.admin_layout')

@section('title', 'Detail Pegawai')

@section('content')

<h4 class="page-title">Detail Data Pegawai</h4>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Profil Pegawai</h5>

        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary btn-sm">
            <i class="la la-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">
    <div class="row">

        {{-- KOLOM FOTO --}}
        <div class="col-md-4 text-center">

            @if ($pegawai->foto)
                <img src="{{ asset('storage/' . $pegawai->foto) }}"
                     class="img-thumbnail mb-3"
                     style="width:180px; height:180px; object-fit:cover; border-radius:50%;">
            @else
                <i class="la la-user-circle text-secondary"
                   style="font-size:180px;"></i>
            @endif

            <h5 class="mt-2 mb-0">{{ $pegawai->nama_pegawai }}</h5>
            <small class="text-muted">{{ $pegawai->jabatan }}</small>

        </div>

        {{-- KOLOM DETAIL --}}
        <div class="col-md-8">
            <table class="table table-sm table-borderless">
                <tr>
                    <th width="35%">NIP</th>
                    <td>: {{ $pegawai->nip }}</td>
                </tr>
                <tr>
                    <th>NIP BPS</th>
                    <td>: {{ $pegawai->nip_bps ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Subbagian/Seksi</th>
                    <td>: {{ $pegawai->subbagian ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Golongan</th>
                    <td>: {{ $pegawai->golongan_akhir }}</td>
                </tr>
                <tr>
                    <th>Pendidikan</th>
                    <td>: {{ $pegawai->pendidikan }}</td>
                </tr>
                <tr>
                    <th>Tempat, Tgl Lahir</th>
                    <td>:
                        {{ $pegawai->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y') }}
                    </td>
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
                    <td>: {{ $pegawai->akun->username ?? 'Belum terhubung' }}</td>
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
