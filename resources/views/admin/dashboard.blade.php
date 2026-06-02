@extends('layout.admin_layout')

@section('title', 'Dashboard Persediaan ATK')

@section('content')

<style>

/* ===== CARD DASHBOARD ===== */
.card-stats{
    border-radius:14px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    transition:0.3s;
}

.card-stats:hover{
    transform:translateY(-3px);
    box-shadow:0 6px 18px rgba(0,0,0,0.12);
}

.card{
    border-radius:10px;
}

/* ICON DASHBOARD */
.icon-dashboard{
    font-size:34px;
    opacity:0.9;
}

/* JUDUL CARD */
.card-category{
    font-size:14px;
    opacity:0.9;
}

/* ANGKA DASHBOARD */
.card-title{
    font-size:26px;
    font-weight:700;
}

</style>

<h4 class="page-title mb-4">Dashboard Persediaan ATK</h4>

{{-- ================= CARD RINGKASAN ================= --}}
<div class="row">

    <div class="col-md-4">
        <a href="{{ url('admin/barang') }}" style="text-decoration:none;">
            <div class="card card-stats card-warning card-ringkasan">
                <div class="card-body text-center">
                    <i class="bi bi-archive-fill" style="font-size:35px;"></i>
                    <p class="card-category mt-2">Total Barang</p>
                    <h4 class="card-title">{{ $totalBarang }}</h4>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ url('admin/barang_keluar') }}" style="text-decoration:none;">
            <div class="card card-stats card-danger card-ringkasan">
                <div class="card-body text-center">
                    <i class="bi bi-bag-dash-fill" style="font-size:35px;"></i>
                    <p class="card-category mt-2">Total Pengambilan</p>
                    <h4 class="card-title">{{ $totalBarangKeluar }}</h4>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ url('admin/barang_masuk') }}" style="text-decoration:none;">
            <div class="card card-stats card-info card-ringkasan">
                <div class="card-body text-center">
                    <i class="bi bi-cart-plus-fill" style="font-size:35px;"></i>
                    <p class="card-category mt-2">Total Pembelian</p>
                    <h4 class="card-title">{{ $totalBarangMasuk }}</h4>
                </div>
            </div>
        </a>
    </div>

</div>



{{-- ================= GRAFIK PENGAMBILAN ================= --}}
<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">Grafik Pengambilan Barang Harian</h4>
    </div>
    <div class="card-body">
        <canvas id="grafikPengambilan" height="90"></canvas>
    </div>
</div>

{{-- ================= TABEL REKAP ================= --}}
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

const ctx = document.getElementById('grafikPengambilan');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($grafikPengambilan->pluck('tanggal')) !!},
        datasets: [{
            label: 'Jumlah Pengambilan',
            data: {!! json_encode($grafikPengambilan->pluck('total')) !!},

            borderWidth:3,
            tension:0.4,
            pointRadius:5,
            pointHoverRadius:7,

            fill:true,
            backgroundColor:"rgba(54,162,235,0.15)"
        }]
    },
    options:{
        responsive:true,
        plugins:{
            legend:{
                display:true
            }
        },
        scales:{
            y:{
                beginAtZero:true
            }
        }
    }
});

</script>

@endsection
