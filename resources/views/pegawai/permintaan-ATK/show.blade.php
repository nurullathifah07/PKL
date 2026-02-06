@extends('layout.pegawai_layout')

@section('title', 'Detail Permintaan ATK')

@section('content')

<div class="card bg-white" id="area-print">
    <div class="card-body text-dark" style="font-family:'Times New Roman'; font-size:14px;">

        {{-- HEADER LOGO --}}
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

        <h5 class="text-center"><u>PERMINTAAN ATK / ARK</u></h5>

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
                <td>{{ $barangKeluar->pegawai->subbagian ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($barangKeluar->tanggal_keluar)->format('d-m-Y') }}</td>
            </tr>
        </table>

        <br>

        {{-- TABEL BARANG --}}
        <table width="100%" border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr align="center">
                    <th width="5%">No<br>(1)</th>
                    <th width="15%">Banyaknya<br>(2)</th>
                    <th>Nama Barang<br>(3)</th>
                    <th width="20%">Keterangan<br>(5)</th>
                </tr>
            </thead>

            <tbody>
                @foreach($barangKeluar->details as $i => $d)
                <tr>
                    <td align="center">{{ $i+1 }}</td>
                    <td align="center">{{ $d->jumlah_keluar }}</td>
                    <td>{{ $d->barang->nama_barang }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <br><br>

        {{-- TANGGAL --}}
        
        <table width="100%">
            <tr>
                <td width="60%"></td>
                <td width="40%" align="center">
                    Martapura,
                    {{ \Carbon\Carbon::parse($barangKeluar->tanggal_keluar)->format('d-m-Y') }}
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
                    <strong>
                        <u>{{ $barangKeluar->pegawai->nama_pegawai }}</u>
                    </strong><br>
                    NIP. {{ $barangKeluar->pegawai->nip ?? '-' }}
                </td>

                <td width="50%" align="center">
                    Mengetahui<br>
                    Kepala Subbagian Umum
                    <div style="height:65px;"></div>

                    @if($pejabatMengetahui)
                        <strong>
                            <u>{{ $pejabatMengetahui->nama_pegawai }}</u>
                        </strong><br>
                        NIP. {{ $pejabatMengetahui->nip ?? '-' }}
                    @else
                        <em>-</em>
                    @endif
                </td>
            </tr>
        </table>

    </div>
</div>


{{-- BUTTON --}}
<div class="text-center mt-3 no-print">
    <button onclick="window.print()" class="btn btn-primary">
        Print
    </button>

    <a href="{{ route('permintaan-ATK.index') }}" class="btn btn-secondary">
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
        position: static;
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
        margin: 0 !important;
    }
}
</style>

@endsection
