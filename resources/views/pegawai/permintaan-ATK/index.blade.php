@extends('layout.pegawai_layout')

@section('title', 'Riwayat Permintaan ATK')

@section('content')

<h4 class="page-title mb-4">Riwayat Permintaan ATK</h4>

<div class="card shadow-sm border-0">

<div class="card-header bg-white d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Permintaan Saya</h5>

    <a href="{{ route('permintaan-ATK.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Ajukan Permintaan
    </a>
</div>

<div class="card-body p-0">
    <table class="table table-hover table-striped mb-0 text-center align-middle">
        <thead class="table-light">
            <tr>
                <th width="60">No</th>
                <th>Barang</th>
                <th width="120">Jumlah</th>
                <th width="150">Tanggal</th>
            </tr>
        </thead>

        <tbody>
        @forelse($riwayat as $row)
            @foreach($row->details as $detail)
            <tr>
                <td>{{ $loop->parent->iteration }}</td>
                <td>{{ $detail->barang->nama_barang }}</td>
                <td>{{ $detail->jumlah_keluar }}</td>
                <td>{{ $row->tanggal_keluar }}</td>
            </tr>
            @endforeach
        @empty
        <tr>
            <td colspan="4">Belum ada data</td>
        </tr>
        @endforelse
        </tbody>

    </table>
</div>

</div>

@endsection
