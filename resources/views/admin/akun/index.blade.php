@extends('layout.admin_layout')

@section('title', 'Daftar Akun')

@section('content')

<h4 class="page-title">Daftar Akun Pengguna</h4>

{{-- TABEL DAFTAR AKUN --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Akun Pengguna</h4>

                    {{-- Tombol Tambah Akun --}}
                    <a href="{{ url('admin/akun/create') }}" class="btn btn-primary btn-round ml-auto">
                        <i class="la la-plus"></i> Tambah Akun
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-hover" class="text-center">
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
                                    <td>********</td> {{-- password jangan ditampilkan --}}
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
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-link btn-simple-danger"
                                                        title="Hapus Akun"
                                                        onclick="return confirm('Yakin hapus akun ini?')">
                                                    <i class="la la-times"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Data akun belum tersedia</td>
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
