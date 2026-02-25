@extends('layout.admin_layout')

@section('title', 'Kartu Persediaan ATK')

@section('content')

<div class="card bg-white" id="area-print">
<div class="card-body text-dark" style="font-family:'Times New Roman'; font-size:13px;">

{{-- ================= HEADER ================= --}}
<table width="100%">
    <tr>
        <td width="10%" align="center">
            <img src="{{ asset('assets/img/logo BPS.png') }}" width="60">
        </td>
        <td width="90%">
            <strong style="font-size:15px;">BADAN PUSAT STATISTIK</strong><br>
            <strong style="font-size:15px;">KABUPATEN BANJAR</strong>
        </td>
    </tr>
</table>

<br>
<h5 class="text-center"><u>KARTU PERSEDIAAN BARANG PAKAI HABIS (ATK)</u></h5>

<br>

{{-- ================= INFO BARANG ================= --}}
<table width="100%">
    <tr>
        <td width="20%">Nama Barang</td>
        <td width="2%">:</td>
        <td width="48%">{{ $barang->nama_barang }}</td>
        <td width="10%">Tahun</td>
        <td width="2%">:</td>
        <td width="18%">{{ $tahun }}</td>
    </tr>
    <tr>
        <td>Kode Barang</td>
        <td>:</td>
        <td>{{ $barang->kode_barang }}</td>
        <td>Satuan</td>
        <td>:</td>
        <td>{{ ucfirst($barang->satuan) }}</td>
    </tr>
</table>

<br>

{{-- ================= REKAP BULANAN ================= --}}
<table width="100%" border="1" cellpadding="4" cellspacing="0">
    <tr class="text-center">
        <th colspan="12">Banyaknya Pengeluaran Tiap-tiap Bulan</th>
        <th rowspan="2">Jumlah<br>Pengeluaran</th>
        <th rowspan="2">Stok<br>Awal</th>
        <th rowspan="2">Stok<br>Akhir</th>
    </tr>
    <tr class="text-center">
        <th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th>
        <th>Mei</th><th>Jun</th><th>Jul</th><th>Agt</th>
        <th>Sep</th><th>Okt</th><th>Nov</th><th>Des</th>
    </tr>
    <tr class="text-center">
        <td>4</td><td>3</td><td>1</td><td>6</td>
        <td>3</td><td>9</td><td>-</td><td>-</td>
        <td>2</td><td>-</td><td>-</td><td>-</td>
        <td>28</td>
        <td>27</td>
        <td>10</td>
    </tr>
</table>

<br>

{{-- ================= TABEL TRANSAKSI ================= --}}
<table width="100%" border="1" cellpadding="4" cellspacing="0">
    <tr class="text-center">
        <th rowspan="2">No</th>
        <th rowspan="2">No. Bon<br>Faktur</th>
        <th rowspan="2">Tgl</th>
        <th rowspan="2">Uraian Pemasukan / Pengeluaran</th>
        <th rowspan="2">Harga<br>Satuan</th>
        <th colspan="2">Jumlah</th>
        <th rowspan="2">Sisa<br>Barang</th>
    </tr>
    <tr class="text-center">
        <th>Masuk</th>
        <th>Keluar</th>
    </tr>

    {{-- SALDO AWAL --}}
    <tr>
        <td class="text-center">1</td>
        <td class="text-center">-</td>
        <td class="text-center">01/01</td>
        <td>Saldo Awal</td>
        <td class="text-center">-</td>
        <td class="text-center">27</td>
        <td class="text-center">-</td>
        <td class="text-center">27</td>
    </tr>

    {{-- CONTOH DATA --}}
    <tr>
        <td class="text-center">2</td>
        <td class="text-center">-</td>
        <td class="text-center">03/01</td>
        <td>Umum</td>
        <td class="text-center">-</td>
        <td class="text-center">-</td>
        <td class="text-center">1</td>
        <td class="text-center">26</td>
    </tr>

    <tr>
        <td class="text-center">3</td>
        <td class="text-center">-</td>
        <td class="text-center">08/01</td>
        <td>Fungsional</td>
        <td class="text-center">-</td>
        <td class="text-center">-</td>
        <td class="text-center">1</td>
        <td class="text-center">25</td>
    </tr>
</table>

</div>
</div>

{{-- ================= BUTTON ================= --}}
<div class="text-center mt-3 no-print">
    <button onclick="window.print()" class="btn btn-primary">
        🖨 Print
    </button>
    <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

{{-- ================= PRINT STYLE ================= --}}
<style>
@media print {
    body * { visibility: hidden; }

    #area-print, #area-print * {
        visibility: visible;
    }

    @page {
        size: A4 portrait;
        margin: 0;
    }

    #area-print {
        width: 210mm;
        padding: 15mm;
        box-sizing: border-box;
    }

    .no-print,
    .main-header,
    .sidebar,
    .footer,
    .btn {
        display: none !important;
    }

    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>

@endsection
