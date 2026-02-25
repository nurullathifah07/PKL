@extends('layout.admin_layout')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            {{-- HEADER --}}
            <div class="text-center mb-4">
                <h6 class="mb-0">BADAN PUSAT STATISTIK</h6>
                <small>KABUPATEN BANJAR</small>
                <h5 class="mt-3 fw-bold">
                    KARTU PERSEDIAAN BARANG PAKAI HABIS (ATK)
                </h5>
            </div>

            {{-- INFO BARANG --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td width="150">Nama Barang</td>
                            <td>: {{ $barang->nama_barang }}</td>
                        </tr>
                        <tr>
                            <td>Kode Barang</td>
                            <td>: {{ $barang->kode_barang ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Satuan</td>
                            <td>: {{ $barang->satuan }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6 text-end">
                    <strong>Tahun : {{ date('Y') }}</strong>
                </div>
            </div>

            {{-- TABEL TRANSAKSI --}}
            <div class="table-responsive">
                <table class="table table-bordered table-sm text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Tanggal</th>
                            <th>Uraian</th>
                            <th width="10%">Masuk</th>
                            <th width="10%">Keluar</th>
                            <th width="10%">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $key => $t)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ date('d/m/Y', strtotime($t->tanggal)) }}</td>
                            <td class="text-start">{{ $t->uraian }}</td>
                            <td>{{ $t->masuk > 0 ? $t->masuk : '' }}</td>
                            <td>{{ $t->keluar > 0 ? $t->keluar : '' }}</td>
                            <td>{{ $t->saldo }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Tidak ada transaksi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- FOOTER --}}
            <div class="mt-4 text-end">
                <small>Dicetak pada {{ date('d/m/Y H:i') }}</small>
            </div>

            <div class="mt-3">
                <a href="{{ route('admin.kartu_persediaan.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </div>
    </div>

</div>

@endsection
