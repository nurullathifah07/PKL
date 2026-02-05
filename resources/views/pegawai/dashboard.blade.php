@extends('layout.pegawai_layout')

@section('title', 'Dashboard Pegawai')

@section('content')

<h4 class="page-title mb-4">Dashboard Pegawai</h4>

{{-- ================= TOP CARDS ================= --}}
<div class="row g-3">

    {{-- Total Barang --}}
    <div class="col-md-6">
        <div class="card shadow-sm border-0 card-stats card-info text-center">
            <div class="card-body">
                <i class="bi bi-box-seam" style="font-size:32px;"></i>
                <p class="mt-2 mb-1">Total Barang Tersedia</p>
                <h3 class="fw-bold">{{ $totalBarang }}</h3>
            </div>
        </div>
    </div>

    {{-- Permintaan Saya --}}
    <div class="col-md-6">
        <div class="card shadow-sm border-0 card-stats card-warning text-center">
            <div class="card-body">
                <i class="bi bi-clipboard-check" style="font-size:32px;"></i>
                <p class="mt-2 mb-1">Permintaan Saya</p>
                <h3 class="fw-bold">{{ $totalPermintaanSaya }}</h3>
            </div>
        </div>
    </div>

</div>


{{-- ================= DAFTAR BARANG ================= --}}
<div class="card mt-4 shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0">Daftar Barang dan Stok</h5>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="text-center">
                <tr>
                    <th width="60">No</th>
                    <th>Nama Barang</th>
                    <th width="120">Stok</th>
                    <th width="120">Satuan</th>
                    <th width="120">Status</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($barang as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>

                    {{-- stok warna otomatis --}}
                    <td class="
                        fw-bold
                        @if($item->stok <= 5) text-danger
                        @elseif($item->stok <= 10) text-warning
                        @else text-success
                        @endif
                    ">
                        {{ $item->stok }}
                    </td>

                    <td>{{ $item->satuan }}</td>
                    <td>
                        @if ($item->status == 'tersedia')
                            <span class="badge badge-success">Tersedia</span>
                        @elseif ($item->status == 'menipis')
                            <span class="badge badge-warning">Menipis</span>
                        @else
                            <span class="badge badge-danger">Habis</span>
                        @endif
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">
                        Belum ada data barang
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
