@extends('layout.admin_layout')

@section('title', 'Daftar Akun')

@section('content')

<h4 class="page-title">Daftar Akun Pengguna</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Akun Pengguna</h4>

                    <a href="{{ url('admin/akun/create') }}"
                       class="btn btn-primary btn-round ml-auto">
                        <i class="la la-plus"></i> Tambah Akun
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table id="tabel-akun" class="display table table-bordered table-hover">

                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Level</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">

                            @forelse ($akun as $index => $a)

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $a->username }}</td>
                                <td>{{ $a->email ?? '-' }}</td>
                                <td>********</td>
                                <td>{{ ucfirst($a->level) }}</td>

                                <td>
                                    <div class="form-button-action">

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.akun.edit', $a->id_akun) }}"
                                           class="btn btn-link btn-simple-primary"
                                           title="Edit Akun">
                                            <i class="la la-edit"></i>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.akun.destroy', $a->id_akun) }}"
                                              method="POST"
                                              class="form-hapus"
                                              data-judul="akun"
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-link btn-simple-danger"
                                                    title="Hapus Akun">
                                                <i class="la la-times"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                            @empty

                            <tr>
                                <td colspan="6" class="text-center">
                                    Data akun belum tersedia
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

    $('#tabel-akun').DataTable({
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
