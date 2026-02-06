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

        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 text-center align-middle">

                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Tanggal</th>
                        <th>Jumlah Item</th>
                        <th>Keterangan</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($riwayat as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- format tanggal biar rapi --}}
                        <td>
                            {{ \Carbon\Carbon::parse($row->tanggal_keluar)->format('d-m-Y') }}
                        </td>

                        {{-- badge jumlah --}}
                        <td>
                            <span class="badge bg-primary">
                                {{ $row->details->count() }} barang
                            </span>
                        </td>

                        <td>{{ $row->keterangan ?? '-' }}</td>

                        <td>
                            <a href="{{ route('permintaan-ATK.show', $row) }}"
                               class="btn btn-sm btn-info">
                                <i class="bi bi-printer"></i> Detail / Print
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted py-4">
                            Belum ada permintaan ATK
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection
