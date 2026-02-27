@extends('layout.operator_layout')

@section('title', 'Daftar Barang Masuk')

@section('content')

<h4 class="page-title">Daftar Barang Masuk</h4>

{{-- TABEL DAFTAR AKUN --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Barang Masuk</h4>

                    {{-- Tombol Tambah Akun --}}
                    <a href="{{ route('operator.barang_masuk.create') }}" class="btn btn-primary btn-round ml-auto">
                        <i class="la la-plus"></i> Tambah Barang Masuk
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>No Bon</th>
                                <th>Tanggal Pembelian</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Satuan Barang</th>
                                <th>Harga Satuan (Rp)</th>
                                <th>Total Harga (Rp)</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($barangMasuk as $bm)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bm->no_bon ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($bm->tanggal_pembelian)->format('d M Y') }}</td>
                                    <td>{{ $bm->barang->nama_barang ?? '-' }}</td>
                                    <td>{{ $bm->jumlah_barang }}</td>
                                    <td>{{ $bm->barang->satuan ?? '-' }}</td>
                                    <td>{{ number_format($bm->harga_satuan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($bm->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="form-button-action">

                                            {{-- EDIT --}}
                                            <a href="{{ route('operator.barang_masuk.edit', $bm->id_barang_masuk) }}"
                                            class="btn btn-link btn-simple-primary"
                                            data-toggle="tooltip"
                                            title="Edit Barang Masuk">
                                                <i class="la la-edit"></i>
                                            </a>

                                            {{-- HAPUS --}}
                                            <form action="{{ route('operator.barang_masuk.destroy', $bm->id_barang_masuk) }}"
                                                method="POST"
                                                style="display:inline-block"
                                                onsubmit="return confirm('Yakin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-link btn-simple-danger"
                                                        data-toggle="tooltip"
                                                        title="Hapus Barang Masuk">
                                                    <i class="la la-times"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        Data barang masuk belum tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
    <script>
        // ...
    </script>
@endsection
