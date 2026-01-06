@extends('layout.admin_layout')

@section('title', 'Tambah Barang Keluar')

@section('content')

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Barang Keluar</h5>
    </div>

    <div class="card-body">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('barang_keluar.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label>Tanggal Keluar</label>
                    <input type="date"
                           name="tanggal_keluar"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Nama Pemohon</label>
                    <input type="text"
                           name="nama_pemohon"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Keterangan</label>
                    <input type="text"
                           name="keterangan"
                           class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Mengetahui</label>
                    <input type="text"
                           name="mengetahui"
                           class="form-control"
                           value="Badal Imamuddin">
                </div>
            </div>

            <hr>

            <h5>Daftar Barang</h5>

            <table class="table table-bordered" id="tabel-barang">
                <thead class="text-center">
                    <tr>
                        <th>Barang</th>
                        <th width="120">Jumlah</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="row-barang">
                        <td>
                            <select name="barang[0][id_barang]"
                                    class="form-control"
                                    required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->id_barang }}">
                                        {{ $b->nama_barang }} (stok: {{ $b->stok }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number"
                                   name="barang[0][jumlah_keluar]"
                                   class="form-control"
                                   min="1"
                                   required>
                        </td>
                        <td class="text-center">
                            <button type="button"
                                    class="btn btn-danger btn-sm btn-remove"
                                    disabled>
                                <i class="la la-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button"
                    class="btn btn-secondary btn-sm"
                    id="tambah-barang">
                + Tambah Barang
            </button>

            <hr>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
                <a href="{{ route('barang_keluar.index') }}"
                   class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
