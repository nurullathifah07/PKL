@extends('layout.admin_layout')

@section('title','Daftar Kartu Kendali')

@section('content')

<h4 class="page-title">Kartu Persediaan</h4>

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white border-0 pt-3">
            <h6 class="mb-0 fw-bold">Kartu Persediaan</h6>
        </div>

        <div class="card-body pt-0">

            <div class="table-responsive">

                <table id="tabel-kartu" class="display table table-bordered table-hover">

                    <thead class="text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">

                        @forelse($barang as $key => $b)

                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td class="fw-semibold text-left">
                                {{ $b->nama_barang }}
                            </td>

                            <td>{{ $b->satuan }}</td>

                            <td>
                                <a href="{{ route('admin.kartu_persediaan.show', $b->id_barang) }}"
                                   class="btn btn-sm btn-primary px-3">
                                    Lihat Kartu
                                </a>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Tidak ada data barang
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection
@section('scripts')

<script>

$(document).ready(function(){

    $('#tabel-kartu').DataTable({
        pageLength: 10,
        searching: false,
        lengthChange: false,
        language:{
            paginate:{
                previous:"Sebelumnya",
                next:"Berikutnya"
            },
            info:"Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty:"Data tidak tersedia",
            zeroRecords:"Data tidak ditemukan"
        }
    });

});

</script>

@endsection
