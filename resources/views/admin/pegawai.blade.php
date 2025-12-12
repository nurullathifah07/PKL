@extends('layout.admin_layout')

@section('title', 'Daftar Pegawai')

@section('content')

<h4 class="page-title">Daftar Pegawai</h4>

{{-- TABEL DAFTAR AKUN --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Pegawai</h4>

                    {{-- Tombol Tambah Akun --}}
                    <a href="{{ url('admin/pegawai_tambah') }}" class="btn btn-primary btn-round ml-auto">
                        <i class="la la-plus"></i> Tambah Pegawai
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>NIP</th>
                                <th>Subbagian</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            {{-- Contoh Baris Data Statis --}}
                            <tr>
                                <td>1</td>
                                <td>Hizrian</td>
                                <td>1998050320220301001</td>
                                <td>Fungsional</td>
                                <td>
                                    <div class="form-button-action">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ url('admin/pegawai_edit') }}">
                                        <button type="button" data-toggle="tooltip" title="Edit Pegawai" class="btn btn-link btn-simple-primary">
                                            <i class="la la-edit"></i>
                                        </button>
                                        </a>
                                        {{-- Tombol Hapus (Delete) --}}
                                        <button type="button" data-toggle="tooltip" title="Hapus Pegawai" class="btn btn-link btn-simple-danger">
                                            <i class="la la-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>M.Otto</td>
                                <td>1999040620200305002</td>
                                <td>Umum</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" data-toggle="tooltip" title="Edit Pegawai" class="btn btn-link btn-simple-primary">
                                            <i class="la la-edit"></i>
                                        </button>
                                        <button type="button" data-toggle="tooltip" title="Hapus Pegawai" class="btn btn-link btn-simple-danger">
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
