@extends('layout.admin_layout')

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
                    <a href="{{ url('admin/barang_masuk_tambah') }}" class="btn btn-primary btn-round ml-auto">
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
                                <th>Tanggal Masuk</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Satuan Barang</th>
                                <th>Harga Satuan (Rp)</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            {{-- Contoh Baris Data Statis --}}
                            <tr>
                                <td>1</td>
                                <td>28 November 2025</td>
                                <td>Sticky Notes</td>
                                <td>12</td>
                                <td>Buah</td>
                                <td>12.000</td>
                                <td>
                                    <div class="form-button-action">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ url('admin/barang_masuk_edit') }}">
                                        <button type="button" data-toggle="tooltip" title="Edit Barang Masuk" class="btn btn-link btn-simple-primary">
                                            <i class="la la-edit"></i>
                                        </button>
                                        </a>
                                        {{-- Tombol Hapus (Delete) --}}
                                        <button type="button" data-toggle="tooltip" title="Hapus Barang Masuk" class="btn btn-link btn-simple-danger">
                                            <i class="la la-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>28 November 2025</td>
                                <td>Paper Clips Warna</td>
                                <td>8</td>
                                <td>Buah</td>
                                <td>5.500</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ url('admin/barang_masuk_edit') }}">
                                        <button type="button" data-toggle="tooltip" title="Edit Barang Masuk" class="btn btn-link btn-simple-primary">
                                            <i class="la la-edit"></i>
                                        </button>
                                        </a>
                                        <button type="button" data-toggle="tooltip" title="Hapus Barang Masuk" class="btn btn-link btn-simple-danger">
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
