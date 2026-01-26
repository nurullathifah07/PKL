@extends('layout.admin_layout')

@section('title', 'Dashboard Persediaan ATK')

@section('content')

<h4 class="page-title mb-4">Dashboard Persediaan ATK</h4>

{{-- ================= CARD RINGKASAN ================= --}}
<div class="row">

    <div class="col-md-4">
        <div class="card card-stats card-warning">
            <div class="card-body text-center">
                <i class="bi bi-archive-fill" style="font-size:35px;"></i>
                <p class="card-category mt-2">Total Barang</p>
                <h4 class="card-title">{{ $totalBarang }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-stats card-danger">
            <div class="card-body text-center">
                <i class="bi bi-bag-dash-fill" style="font-size:35px;"></i>
                <p class="card-category mt-2">Total Pengambilan</p>
                <h4 class="card-title">{{ $totalBarangKeluar }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-stats card-info">
            <div class="card-body text-center">
                <i class="bi bi-cart-plus-fill" style="font-size:35px;"></i>
                <p class="card-category mt-2">Total Pembelian</p>
                <h4 class="card-title">{{ $totalBarangMasuk }}</h4>
            </div>
        </div>
    </div>

</div>

{{-- ================= STOK MENIPIS ================= --}}
<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">Stok Barang Menipis</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th width="50">No</th>
                    <th>Nama Barang</th>
                    <th width="100">Stok</th>
                    <th width="100">Satuan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stokMenipis as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td class="text-danger fw-bold">{{ $item->stok }}</td>
                    <td>{{ $item->satuan }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Tidak ada stok menipis
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ================= GRAFIK PENGAMBILAN ================= --}}
<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">Grafik Pengambilan Barang Harian</h4>
    </div>
    <div class="card-body">
        <canvas id="grafikPengambilan"></canvas>
    </div>
</div>

{{-- ================= TABEL REKAP PENGAMBILAN ================= --}}
<div class="card mt-4 mb-4">
    <div class="card-header">
        <h4 class="card-title">Rekap Pengambilan Barang per Hari</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th width="50">No</th>
                    <th>Tanggal</th>
                    <th width="150">Jumlah Pengambilan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grafikPengambilan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td class="fw-bold">{{ $item->total }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">
                        Belum ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('grafikPengambilan'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($grafikPengambilan->pluck('tanggal')) !!},
        datasets: [{
            label: 'Jumlah Pengambilan',
            data: {!! json_encode($grafikPengambilan->pluck('total')) !!},
            borderWidth: 1
        }]
    }
});
</script>
@endsection
