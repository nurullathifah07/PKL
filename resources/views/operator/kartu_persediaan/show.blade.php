@extends('layout.operator_layout')

@section('content')

<style>
    /* Hilangkan background dashboard */
    .page-inner {
        background: #fff !important;
    }

    .kartu-wrapper {
        background: #fff;
        padding: 40px;
        font-size: 12px;
        max-width: 1200px;
        margin: auto;
    }

    /* HEADER */
    .header-area {
        position: relative;
        margin-bottom: 20px;
    }

    .header-area img {
        position: absolute;
        left: 0;
        top: 0;
        width: 75px;
    }

    .header-title {
        text-align: center;
    }

    .header-title .instansi {
        font-weight: 600;
        font-size: 14px;
    }

    .header-title .kabupaten {
        font-size: 12px;
        margin-top: -2px;
    }

    .header-title .judul {
        font-weight: 700;
        font-size: 20px;
        margin-top: 10px;
        border-bottom: 1px solid #999;
        padding-bottom: 6px;
        letter-spacing: .5px;
    }

    .tahun-area {
        position: absolute;
        right: 0;
        top: 50px;
        font-size: 12px;
    }

    /* TABLE */
    .table-kartu th,
    .table-kartu td,
    .table-bulan th,
    .table-bulan td {
        border: 1px solid #000 !important;
        padding: 4px !important;
        font-size: 11px;
    }

    .table-bulan th,
    .table-bulan td {
        text-align: center;
    }

    @media print {
        @page {
            size: A4 landscape;
            margin: 15px;
        }

        .no-print {
            display: none !important;
        }

        .sidebar,
        .navbar {
            display: none !important;
        }

        .main-panel {
            width: 100% !important;
        }
    }
</style>

<div class="kartu-wrapper">

    {{-- HEADER --}}
    <div class="mb-4">

    <div class="d-flex align-items-start justify-content-between">

        {{-- KIRI: LOGO + NAMA INSTANSI --}}
        <div class="text-center">
            <img src="{{ asset('assets/img/logo BPS.png') }}" width="40">

            <div style="font-size:13px; font-weight:600; margin-top:8px;">
                BADAN PUSAT STATISTIK
            </div>
            <div style="font-size:12px;">
                KABUPATEN BANJAR
            </div>
        </div>

        {{-- KANAN: TAHUN --}}
        <div style="font-size:12px;">
            <strong>Tahun : {{ date('Y') }}</strong>
        </div>

    </div>

    {{-- JUDUL TENGAH --}}
    <div class="text-center"
     style="margin-top:-30px;
            font-weight:700;
            font-size:20px;
            border-bottom:1px solid #999;
            padding-bottom:6px;
            letter-spacing:.5px;">
        KARTU PERSEDIAAN BARANG PAKAI HABIS (ATK)
    </div>

</div>

    {{-- INFO BARANG --}}
    <table class="table table-borderless table-sm mb-3" style="width:60%">
        <tr>
            <td width="150">Nama Barang</td>
            <td>: {{ $barang->nama_barang }}</td>
        </tr>
        <tr>
            <td>Kode Barang</td>
            <td>: {{ $barang->kode_barang ?? '-' }}</td>
        </tr>
        <tr>
            <td>Satuan Barang</td>
            <td>: {{ $barang->satuan }}</td>
        </tr>
    </table>

    {{-- TABEL BULANAN --}}
    <table class="table table-bulan mb-4">
        <tr>
            <th colspan="12">Banyaknya Pengeluaran Tiap-tiap Bulan</th>
            <th rowspan="2">Jumlah Pengeluaran</th>
            <th rowspan="2">Stok Awal</th>
            <th rowspan="2">Stok Akhir</th>
        </tr>
        <tr>
            @foreach(['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'] as $bln)
                <th>{{ $bln }}</th>
            @endforeach
        </tr>
        <tr>
            @for($i=1;$i<=12;$i++)
                <td>{{ $rekapBulanan[$i] ?? '' }}</td>
            @endfor
            <td>{{ $jumlah_keluar }}</td>
            <td>{{ $stokAwal }}</td>
            <td>{{ $stokAkhir }}</td>
        </tr>
    </table>

    {{-- TABEL TRANSAKSI --}}
    <table class="table table-kartu text-center align-middle">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="10%">No. Bon/Faktur</th>
                <th width="10%">Tgl M/K</th>
                <th>Uraian Pemasukan/Pengeluaran</th>
                <th width="8%">Harga</th>
                <th width="7%">Masuk</th>
                <th width="7%">Keluar</th>
                <th width="7%">Sisa</th>
                <th width="4%">No</th>
                <th width="10%">No. Bon/Faktur</th>
                <th width="10%">Tgl M/K</th>
                <th>Uraian Pemasukan/Pengeluaran</th>
                <th width="8%">Harga</th>
                <th width="7%">Masuk</th>
                <th width="7%">Keluar</th>
                <th width="7%">Sisa</th>
            </tr>
        </thead>
        @php
        $rowsPerColumn = 16; // sesuaikan dengan kartu asli
        $leftData = $transaksi->slice(0, $rowsPerColumn);
        $rightData = $transaksi->slice($rowsPerColumn, $rowsPerColumn);
        @endphp

        <tbody>
        @for ($i = 0; $i < $rowsPerColumn; $i++)
            @php
                $left = $leftData[$i] ?? null;
                $right = $rightData[$i] ?? null;
            @endphp
            <tr>
                {{-- KOLOM KIRI --}}
                <td>{{ $i + 1 }}</td>
                <td>{{ $left->no_bon ?? '-' }}</td>
                <td>{{ isset($left->tanggal) ? date('d/m/Y', strtotime($left->tanggal)) : '' }}</td>
                <td class="text-start">{{ $left->uraian ?? '' }}</td>
                <td>{{ isset($left->harga_satuan) ? number_format($left->harga_satuan,0,',','.') : '-' }}</td>
                <td>{{ ($left->masuk ?? 0) > 0 ? $left->masuk : '' }}</td>
                <td>{{ ($left->keluar ?? 0) > 0 ? $left->keluar : '' }}</td>
                <td>{{ $left->saldo ?? '' }}</td>

                {{-- KOLOM KANAN --}}
                <td>{{ $i + 1 + $rowsPerColumn }}</td>
                <td>{{ $right->no_bon ?? '-' }}</td>
                <td>{{ isset($right->tanggal) ? date('d/m/Y', strtotime($right->tanggal)) : '' }}</td>
                <td class="text-start">{{ $right->uraian ?? '' }}</td>
                <td>{{ isset($right->harga_satuan) ? number_format($right->harga_satuan,0,',','.') : '-' }}</td>
                <td>{{ ($right->masuk ?? 0) > 0 ? $right->masuk : '' }}</td>
                <td>{{ ($right->keluar ?? 0) > 0 ? $right->keluar : '' }}</td>
                <td>{{ $right->saldo ?? '' }}</td>
            </tr>
        @endfor
        </tbody>
    </table>


    {{-- FOOTER --}}
    <div class="mt-3 text-end">
        Dicetak pada {{ date('d/m/Y H:i') }}
    </div>

    <div class="mt-3 no-print">
        <button onclick="window.print()" class="btn btn-primary">
            Print
        </button>
        <a href="{{ route('operator.kartu_persediaan.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>
    </div>

</div>

@endsection
