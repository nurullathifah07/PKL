@extends('layout.admin_layout')

@section('title', 'Daftar Barang Masuk')

@section('content')

<h4 class="page-title">Daftar Barang Masuk</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Barang Masuk</h4>

                    <a href="{{ route('admin.barang_masuk.create') }}"
                       class="btn btn-primary btn-round ml-auto">
                        <i class="la la-plus"></i> Tambah Barang Masuk
                    </a>
                </div>
            </div>

            {{-- BODY --}}
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
                                <th style="width:10%">Aksi</th>
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
                                            <a href="{{ route('admin.barang_masuk.edit', $bm->id_barang_masuk) }}"
                                               class="btn btn-link btn-simple-primary"
                                               title="Edit Barang Masuk">
                                                <i class="la la-edit"></i>
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('admin.barang_masuk.destroy', $bm->id_barang_masuk) }}"
                                                method="POST"
                                                class="form-hapus"
                                                data-judul="barang masuk"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-link btn-danger btn-sm"
                                                        title="Hapus">
                                                    <i class="la la-times"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="9" class="text-muted">
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
$(document).ready(function () {
    $('#add-row').DataTable({
        pageLength: 10, // tampil 10 data
        searching: false, // hilangkan search
        lengthChange: false, // hilangkan show entries
        language: {
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya"
            },
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Data tidak tersedia",
            zeroRecords: "Data tidak ditemukan"
        }
    });
});
</script>

@endsection
