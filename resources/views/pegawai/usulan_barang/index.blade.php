@extends('layout.pegawai_layout')

@section('title', 'Usulan Barang Baru')

@section('content')

<div class="container-fluid">

    <h4 class="page-title mb-4 text-gray-800">Usulan Barang</h4>

    {{-- tombol tambah --}}
    <a href="{{ route('pegawai.usulan_barang.create') }}" class="btn btn-primary mb-3">
        Tambah Usulan
    </a>

    <div class="card shadow">
        <div class="card-body">

            <table id="tabel-usulan-pegawai" class="display table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody class="text-center">

                @forelse($usulan as $u)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $u->created_at->format('d-m-Y') }}</td>

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
                    <td colspan="6" class="text-center">
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


@section('scripts')

<script>
$(document).ready(function(){

    $('#tabel-usulan-pegawai').DataTable({
        pageLength: 10,
        searching: false,
        lengthChange: false,
        language: {
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya"
            },
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Data tidak tersedia",
            zeroRecords: "Data tidak ditemukan"
        }
    });

});
</script>

@endsection
