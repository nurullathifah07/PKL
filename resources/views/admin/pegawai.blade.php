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
                                <th>NIP BPS</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Jabatan</th>
                                <th>Golongan Akhir</th>
                                <th>Pendidikan</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            {{-- Contoh Baris Data Statis --}}
                            <tr>
                                <td>1</td>
                                <td>340018756</td>
                                <td>198305042006041011</td>
                                <td>Muhammad Wira Perdana</td>
                                <td>Statistisi Mahir BPS Kabupaten/Kota</td>
                                <td>III/c</td>
                                <td>SMU IPA</td>
                                <td>Martapura</td>
                                <td>04-05-1983</td>
                                <td>LK</td>
                                <td>Islam</td>
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
                                <td>340052319</td>
                                <td>198407192009012008</td>
                                <td>Yulia Sapitri, SE</td>
                                <td>Statistisi Mahir BPS Kabupaten/Kota</td>
                                <td>III/b</td>
                                <td>S-1 Akuntansi</td>
                                <td>Martapura</td>
                                <td>19-07-1984</td>
                                <td>PR</td>
                                <td>Islam</td>
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
