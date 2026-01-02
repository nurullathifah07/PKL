@extends('layout.admin_layout')

@section('title', 'Detail Barang Keluar')

@section('content')

<div class="card shadow" id="area-print">
    <div class="card-header bg-primary text-white text-center">
        <h5 class="mb-0">SURAT BARANG KELUAR</h5>
    </div>

    <div class="card-body">

        {{-- HEADER INFO --}}
        <table class="table table-borderless mb-4">
            <tr>
                <td width="150">Tanggal Keluar</td>
                <td width="10">:</td>
                <td>{{ \Carbon\Carbon::parse($barangKeluar->tanggal_keluar)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Nama Pemohon</td>
                <td>:</td>
                <td>{{ $barangKeluar->nama_pemohon }}</td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td>{{ $barangKeluar->keterangan ?? '-' }}</td>
            </tr>
        </table>

        {{-- TABEL BARANG --}}
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light text-center">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Barang</th>
                        <th width="120">Jumlah Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangKeluar->details as $i => $details)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $details->barang->nama_barang }}</td>
                            <td class="text-center">{{ $details->jumlah_keluar }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- TANDA TANGAN --}}
        <div class="row mt-5">
            <div class="col-md-6 text-center">
                <p>Mengetahui,</p>
                <br><br><br>
                <p><u>___________________</u></p>
            </div>
            <div class="col-md-6 text-center">
                <p>Pemohon,</p>
                <br><br><br>
                <p><u>{{ $barangKeluar->nama_pemohon }}</u></p>
            </div>
        </div>

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

{{-- CSS PRINT --}}
<style>
@media print {
    body * {
        visibility: hidden;
    }

    #area-print, #area-print * {
        visibility: visible;
    }

    #area-print {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    .no-print {
        display: none;
    }
}
</style>

@endsection
