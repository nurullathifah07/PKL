@extends('layout.admin_layout')

@section('title', 'Detail Barang Keluar')

@section('content')

<div class="card bg-white" id="area-print">
    <div class="card-body text-dark" style="font-family: 'Times New Roman'; font-size: 14px;">

        {{-- HEADER --}}
        <table width="100%">
            <tr>
                <td width="10%" align="center">
                    <img src="{{ asset('assets/img/logo BPS.png') }}" width="60">
                </td>
                <td width="100%">
                    <strong style="font-size:15px;">BADAN PUSAT STATISTIK</strong><br>
                    <strong style="font-size:15px;">KABUPATEN BANJAR</strong>
                </td>
            </tr>
        </table>

        <br>
        <h5 class="text-center"><u>PERMINTAAN ATK / ARK</u></h5>
    </div>

    <br>

        {{-- INFO --}}
        <table width="100%">
            <tr>
                <td width="25%">Tujuan</td>
                <td width="2%">:</td>
                <td>Kepada Yth. Kasubbag Umum</td>
            </tr>
            <tr>
                <td>Dari Subbagian/Seksi</td>
                <td>:</td>
                <td>{{ $barangKeluar->keterangan ?? '-' }}</td>
            </tr>
        </table>

        <br>

        {{-- TABEL BARANG --}}
        <table width="100%" border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr class="text-center">
                    <th width="5%">No<br>(1)</th>
                    <th width="15%">Banyaknya<br>(2)</th>
                    <th>Nama Barang<br>(3)</th>
                    <th width="20%">Keterangan<br>(5)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangKeluar->details as $i => $d)
                <tr>
                    <td class="text-center">{{ $i+1 }}</td>
                    <td class="text-center">{{ $d->jumlah_keluar }}</td>
                    <td>{{ $d->barang->nama_barang }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table width="100%" style="margin-top:15px;">
            <tr>
                <td width="40%"></td>
                <td width="40%" align="center">
                    Martapura, {{ \Carbon\Carbon::parse($barangKeluar->tanggal_keluar)->format('d-m-Y') }}
                </td>
            </tr>
        </table>

        <br>

        {{-- TANDA TANGAN --}}
        <table width="100%">
            <tr>
                <td width="50%" align="center">
                    Yang menerima,
                    <div style="height:70px;"></div>
                    <strong><u>{{ $barangKeluar->nama_pemohon }}</u></strong><br>
                    NIP.
                </td>

                <td width="50%" align="center">
                    Mengetahui<br>
                    Kepala Subbagian Umum
                    <div style="height:65px;"></div>
                    <strong><u>Badal Imamuddin</u></strong><br>
                    NIP. 198xxxxxxxx
                </td>
            </tr>
        </table>

    </div>
</div>

{{-- BUTTON --}}
<div class="text-center mt-3 no-print">
    <button onclick="window.print()" class="btn btn-primary">
        <i class="la la-print"></i> Print
    </button>
    <a href="{{ route('barang_keluar.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

{{-- PRINT STYLE --}}
<style>
@media print {

    body * {
        visibility: hidden;
    }
    #area-print, #area-print * {
        visibility: visible;
    }

    @page {
        size: A4 portrait;
        margin: 0;
    }

    #area-print {
        visibility: visible;
        position: static;
        width: 210mm;
        height: 170mm;

        padding: 15mm;
        box-sizing: border-box;

        overflow: hidden;
        page-break-after: cut;
    }

    .no-print, .main-header, .sidebar, .footer, .btn {
        display: none !important;
    }

    .card {
        border: none !important;
        box-shadow: none !important;
        margin: 0 !important;
    }
}
</style>

@endsection
