@extends('layout.admin_layout')

@section('title', 'Notifikasi Stok Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="page-title">Notifikasi Stok Barang</h4>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">⚠️ Daftar Stok Barang Menipis</h6>
    </div>
    <div class="card-body">

        {{-- Logika Blade untuk mengecek apakah ada data notifikasi --}}
        @if (isset($stok_menipis) && $stok_menipis->isNotEmpty())

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Nama Barang</th>
                            <th style="width: 15%;">Stok Saat Ini</th>
                            <th style="width: 10%;">Satuan</th>
                            <th style="width: 15%;">Batas Minimum</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- LOOPING data barang yang stoknya menipis dari Controller --}}
                        @foreach ($stok_menipis as $index => $barang)
                        {{-- Memberi warna baris berdasarkan tingkat urgensi stok --}}
                        <tr class="{{ $barang->stok <= 5 ? 'table-danger' : 'table-warning' }}">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>
                                <strong>{{ $barang->stok }}</strong>
                            </td>
                            <td>{{ $barang->satuan }}</td>
                            <td>10</td> {{-- Asumsi batas minimum 10 --}}
                            <td>
                                <a href="{{ route('admin.barang_masuk.tambah') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Stok
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else
            {{-- Tampilkan pesan jika tidak ada notifikasi --}}
            <div class="alert alert-success text-center" role="alert">
                🎉 Semua stok barang dalam kondisi aman. Tidak ada notifikasi saat ini.
            </div>
        @endif

    </div>
</div>

@endsection
