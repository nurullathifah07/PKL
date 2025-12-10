@extends('layout.admin_layout')

@section('title', 'Dashboard Persediaan ATK')

@section('content')

<h4 class="page-title">Dashboard Persediaan ATK</h4>

{{-- Hapus baris pemisah horizontal --- --}}

<div class="row">
    {{-- 1. Total Item Unik (Diubah menjadi col-md-4) --}}
    <div class="col-md-4">
        <div class="card card-stats card-warning">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="bi bi-archive-fill" style="font-size: 35px;"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        <div class="numbers text-center">
                            <p class="card-category">Total Barang</p>
                            <h4 class="card-title" style="margin-top: 5px;">128</h4> {{-- Ganti dengan data DB --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Item Stok Kritis (Diubah menjadi col-md-4) --}}
    <div class="col-md-4">
        <div class="card card-stats card-danger">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="bi bi-bag-dash-fill" style="font-size: 35px;"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        <div class="numbers text-center">
                            <p class="card-category">Total Permintaan</p>
                            <h4 class="card-title" style="margin-top: 5px;">15</h4> {{-- Ganti dengan data DB --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Total Transaksi Masuk (Diubah menjadi col-md-4) --}}
    <div class="col-md-4">
        <div class="card card-stats card-info">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="bi bi-cart-plus-fill" style="font-size: 35px;"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        <div class="numbers text-center">
                            <p class="card-category">Total Pembelian</p>
                            <h4 class="card-title" style="margin-top: 5px;">17</h4> {{-- Ganti dengan data DB --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CATATAN: CARD KEEMPAT (Total Transaksi Keluar) DIHILANGKAN AGAR TAMPILAN 3 KOLOM SERAGAM --}}
</div>

{{-- Hapus baris pemisah horizontal --- --}}

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Task</h4>
                <p class="card-category">Complete</p>
            </div>
            <div class="card-body">
                <div id="task-complete" class="chart-circle mt-4 mb-3"></div>
            </div>
            <div class="card-footer">
                <div class="legend"><i class="la la-circle text-primary"></i> Completed</div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">World Map</h4>
                <p class="card-category">
                Map of the distribution of users around the world</p>
            </div>
            <div class="card-body">
                <div class="mapcontainer">
                    <div class="map">
                        <span>Alternative content for the map</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row row-card-no-pd">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <p class="fw-bold mt-1">My Balance</p>
                <h4><b>$ 3,018</b></h4>
                <a href="#" class="btn btn-primary btn-full text-left mt-3 mb-3"><i class="la la-plus"></i> Add Balance</a>
            </div>
            <div class="card-footer">
                <ul class="nav">
                    <li class="nav-item"><a class="btn btn-default btn-link" href="#"><i class="la la-history"></i> History</a></li>
                    <li class="nav-item ml-auto"><a class="btn btn-default btn-link" href="#"><i class="la la-refresh"></i> Refresh</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="progress-card">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Profit</span>
                        <span class="text-muted fw-bold"> $3K</span>
                    </div>
                    <div class="progress mb-2" style="height: 7px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="78%"></div>
                    </div>
                </div>
                <div class="progress-card">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Orders</span>
                        <span class="text-muted fw-bold"> 576</span>
                    </div>
                    <div class="progress mb-2" style="height: 7px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="65%"></div>
                    </div>
                </div>
                <div class="progress-card">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Tasks Complete</span>
                        <span class="text-muted fw-bold"> 70%</span>
                    </div>
                    <div class="progress mb-2" style="height: 7px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="70%"></div>
                    </div>
                </div>
                <div class="progress-card">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Open Rate</span>
                        <span class="text-muted fw-bold"> 60%</span>
                    </div>
                    <div class="progress mb-2" style="height: 7px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="60%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats">
            <div class="card-body">
                <p class="fw-bold mt-1">Statistic</p>
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center icon-warning">
                            <i class="la la-pie-chart text-warning"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        <div class="numbers">
                            <p class="card-category">Number</p>
                            <h4 class="card-title">150GB</h4>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la-heart-o text-primary"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        <div class="numbers">
                            <p class="card-category">Followers</p>
                            <h4 class="card-title">+45K</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        // ... kode inisialisasi Circles, Charts, Maps di sini (dari demo.js) ...
        Circles.create({
            id: 'task-complete',
            radius: 75,
            value: 80,
            maxValue: 100,
            width: 8,
            text: '80%',
            colors: ['#eee', '#177dff'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        });
    </script>
@endsection
