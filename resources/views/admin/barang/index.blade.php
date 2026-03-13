@extends('layout.admin_layout')

@section('title', 'Daftar Barang')

@section('content')

<h4 class="page-title">Daftar Barang</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Barang</h4>

                    <a href="{{ route('admin.barang.create') }}"
                       class="btn btn-primary btn-round ml-auto">
                        <i class="la la-plus"></i> Tambah Barang
                    </a>
                </div>
            </div>

            {{-- BODY --}}
            <div class="card-body">
                <div class="table-responsive">

                    <table id="tabel-barang" class="display table table-bordered table-hover">

                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Stok Minimal</th>
                                <th>Status</th>
                                <th>Stok</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">

                            @forelse ($barang as $b)

                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b->kode_barang }}</td>
                                <td>{{ $b->nama_barang }}</td>
                                <td>{{ ucfirst($b->satuan) }}</td>
                                <td>{{ $b->stok_minimal }}</td>

                                {{-- STATUS --}}
                                <td>

                                    @if ($b->status == 'tersedia')
                                        <span class="badge badge-success">
                                            Tersedia
                                        </span>

                                    @elseif ($b->status == 'menipis')
                                        <span class="badge badge-warning">
                                            Menipis
                                        </span>

                                    @else
                                        <span class="badge badge-danger">
                                            Habis
                                        </span>

                                    @endif

                                </td>

                                <td>{{ $b->stok }}</td>

                                {{-- AKSI --}}
                                <td>
                                    <div class="form-button-action">

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.barang.edit',$b->id_barang) }}"
                                           class="btn btn-link btn-primary btn-sm"
                                           title="Edit">
                                            <i class="la la-edit"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ route('admin.barang.destroy',$b->id_barang) }}"
                                              method="POST"
                                              class="form-hapus"
                                              data-judul="barang"
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-link btn-danger btn-sm"
                                                    title="Hapus Barang">
                                                <i class="la la-times"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Data barang belum tersedia
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

$(document).ready(function(){

    $('#tabel-barang').DataTable({

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
