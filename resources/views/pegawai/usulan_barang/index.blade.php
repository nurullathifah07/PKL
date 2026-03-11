@extends('layout.pegawai_layout')

@section('content')

<div class="container-fluid">

    <h4 class="page-title mb-4 text-gray-800">Usulan Barang</h4>

    {{-- tombol tambah --}}
    <a href="{{ route('pegawai.usulan_barang.create') }}" class="btn btn-primary mb-3">
        Tambah Usulan
    </a>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($usulan as $u)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $u->nama_barang_usulan }}</td>

                    <td>{{ $u->jumlah_usulan }}</td>

                    <td>{{ $u->keterangan }}</td>

                    <td>

                        @if($u->status == 'pending')
                            <span class="badge badge-warning">
                                Menunggu
                            </span>

                        @elseif($u->status == 'disetujui')
                            <span class="badge badge-success">
                                Disetujui
                            </span>

                        @elseif($u->status == 'ditolak')
                            <span class="badge badge-danger">
                                Ditolak
                            </span>

                            <br>
                            <small class="text-muted">
                                Alasan: {{ $u->alasan_penolakan }}
                            </small>

                        @endif

                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center">
                        Belum ada usulan barang
                    </td>
                </tr>

                @endforelse

                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
