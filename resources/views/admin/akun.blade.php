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
                    <a href="{{ url('admin/akun_tambah') }}" class="btn btn-primary btn-round ml-auto">
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
                            {{-- Contoh Baris Data Statis --}}
                            <tr>
                                <td>1</td>
                                <td>hizrian</td>
                                <td>hizrian@example.com</td>
                                <td>jdnckjnsne3j4#238u3r</td>
                                <td>Administrator</td>
                                <td>
                                    <div class="form-button-action">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ url('admin/akun_edit') }}">
                                        <button type="button" data-toggle="tooltip" title="Edit Akun" class="btn btn-link btn-simple-primary">
                                            <i class="la la-edit"></i>
                                        </button>
                                        </a>
                                        {{-- Tombol Hapus (Delete) --}}
                                        <button type="button" data-toggle="tooltip" title="Hapus Akun" class="btn btn-link btn-simple-danger">
                                            <i class="la la-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>mark_otto</td>
                                <td>mark@example.com</td>
                                <td>jdnckjnsne3j4#238u3r</td>
                                <td>User Biasa</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" data-toggle="tooltip" title="Edit Akun" class="btn btn-link btn-simple-primary">
                                            <i class="la la-edit"></i>
                                        </button>
                                        <button type="button" data-toggle="tooltip" title="Hapus Akun" class="btn btn-link btn-simple-danger">
                                            <i class="la la-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>mark_otto</td>
                                <td>mark@example.com</td>
                                <td>jdnckjnsne3j4#238u3r</td>
                                <td>User Biasa</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" data-toggle="tooltip" title="Edit Akun" class="btn btn-link btn-simple-primary">
                                            <i class="la la-edit"></i>
                                        </button>
                                        <button type="button" data-toggle="tooltip" title="Hapus Akun" class="btn btn-link btn-simple-danger">
                                            <i class="la la-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            {{-- END Contoh Baris Data --}}

                            {{-- Di sinilah Anda akan melakukan looping data dari database menggunakan @foreach --}}
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
