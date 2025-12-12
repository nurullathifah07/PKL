@extends('layout.admin_layout')

@section('title', 'Daftar Pembelian Barang')

@section('content')

<h4 class="page-title">Daftar Barang Keluar</h4>

{{-- TABEL DAFTAR AKUN --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Barang Keluar</h4>

                    {{-- Tombol Tambah Akun --}}
                    <a href="{{ url('admin/barang_keluar_tambah') }}" class="btn btn-primary btn-round ml-auto">
                        <i class="la la-plus"></i> Tambah Barang Keluar
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
                                <th>Tanggal Keluar</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Keterangan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            {{-- Contoh Baris Data Statis --}}
                            <tr>
                                <td>1</td>
                                <td>Hizrian</td>
                                <td>2 Desember 2025</td>
                                <td>Pen Kenko K.1 Hitam</td>
                                <td>1</td>
                                <td></td>
                                <td>
                                    <div class="form-button-action">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ url('admin/barang_keluar_edit') }}">
                                        <button type="button" data-toggle="tooltip" title="Edit Barang Keluar" class="btn btn-link btn-simple-primary">
                                            <i class="la la-edit"></i>
                                        </button>
                                        </a>
                                        {{-- Tombol Hapus (Delete) --}}
                                        <button type="button" data-toggle="tooltip" title="Hapus Barang Keluar" class="btn btn-link btn-simple-danger">
                                            <i class="la la-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>M.Otto</td>
                                <td>2 Desember 2025</td>
                                <td>Pen Kenko K.1 Biru</td>
                                <td>1</td>
                                <td></td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" data-toggle="tooltip" title="Edit Barang Keluar" class="btn btn-link btn-simple-primary">
                                            <i class="la la-edit"></i>
                                        </button>
                                        <button type="button" data-toggle="tooltip" title="Hapus Barang Keluar" class="btn btn-link btn-simple-danger">
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
