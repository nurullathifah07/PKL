@extends('layout.admin_layout')

@section('title', 'Daftar Pegawai')

@section('content')

<h4 class="page-title">Daftar Pegawai</h4>

{{-- TABEL DAFTAR AKUN --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Pegawai</h4>

                    {{-- Tombol Tambah Akun --}}
                    <a href="{{ url('admin/pegawai/create') }}" class="btn btn-primary btn-round ml-auto">
                        <i class="la la-plus"></i> Tambah Pegawai
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>NIP BPS</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Jabatan</th>
                                <th>Golongan Akhir</th>
                                <th>Pendidikan</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Username</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($pegawai as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->nip_bps }}</td>
                                <td>{{ $p->nip }}</td>
                                <td>{{ $p->nama_pegawai }}</td>
                                <td>{{ $p->jabatan }}</td>
                                <td>{{ $p->golongan_akhir }}</td>
                                <td>{{ $p->pendidikan }}</td>
                                <td>{{ $p->tempat_lahir }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}</td>
                                <td>{{ $p->jenis_kelamin }}</td>
                                <td>{{ $p->agama }}</td>
                                <td>{{ $p->akun->username ?? '-' }}</td>
                                <td>
                                    <div class="form-button-action">

                                        {{-- SHOW --}}
                                        <a href="{{ route('pegawai.show', $p->id_pegawai) }}"
                                        class="btn btn-link btn-info btn-sm">
                                            <i class="la la-eye action-icon"></i>
                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('pegawai.edit', $p->id_pegawai) }}"
                                        class="btn btn-link btn-primary btn-sm">
                                            <i class="la la-edit action-icon"></i>
                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('pegawai.destroy', $p->id_pegawai) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-link btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="la la-times action-icon"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>

                            @empty
                            <tr>
                                <td colspan="13" class="text-center text-muted">
                                    Data pegawai belum tersedia
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
    <script>
        // ...
    </script>
@endsection
