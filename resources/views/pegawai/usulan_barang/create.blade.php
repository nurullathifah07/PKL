@extends('layout.pegawai_layout')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Tambah Usulan Barang</h1>

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('pegawai.usulan_barang.store') }}" method="POST">
                @csrf

                {{-- Nama Barang --}}
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text"
                           name="nama_barang_usulan"
                           class="form-control"
                           placeholder="Masukkan nama barang"
                           required>
                </div>

                {{-- Jumlah --}}
                <div class="form-group">
                    <label>Jumlah Usulan</label>
                    <input type="number"
                           name="jumlah_usulan"
                           class="form-control"
                           placeholder="Masukkan jumlah barang"
                           required>
                </div>

                {{-- Keterangan --}}
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control"
                              rows="3"
                              placeholder="Keterangan tambahan (opsional)"></textarea>
                </div>

                <br>

                {{-- tombol --}}
                <button type="submit" class="btn btn-success">
                    Simpan Usulan
                </button>

                <a href="{{ route('pegawai.usulan_barang.index') }}"
                   class="btn btn-secondary">
                   Kembali
                </a>

            </form>

        </div>
    </div>

</div>

@endsection
