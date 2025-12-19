@extends('layout.admin_layout')

@section('title', 'Edit Barang Masuk')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header">
        <h5 class="m-0 font-weight-bold text-primary">Edit Barang Masuk</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('barang_masuk.update', $barangMasuk->id_barang_masuk) }}"
              method="POST">
            @csrf
            @method('PUT')

            {{-- TANGGAL --}}
            <div class="mb-3">
                <label class="form-label">Tanggal Pembelian</label>
                <input type="date"
                       name="tanggal_pembelian"
                       class="form-control"
                       value="{{ old('tanggal_pembelian', $barangMasuk->tanggal_pembelian) }}"
                       required>
            </div>

            {{-- NAMA BARANG (READ ONLY) --}}
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text"
                       class="form-control"
                       value="{{ $barangMasuk->barang->nama_barang }} ({{ $barangMasuk->barang->satuan }})"
                       readonly>
            </div>

            {{-- JUMLAH --}}
            <div class="mb-3">
                <label class="form-label">Jumlah Barang Masuk</label>
                <input type="number"
                       name="jumlah_barang"
                       class="form-control"
                       min="1"
                       value="{{ old('jumlah_barang', $barangMasuk->jumlah_barang) }}"
                       required>
            </div>

            {{-- HARGA --}}
            <div class="mb-3">
                <label class="form-label">Harga Satuan (Rp)</label>
                <input type="number"
                       name="harga_satuan"
                       class="form-control"
                       min="0"
                       value="{{ old('harga_satuan', $barangMasuk->harga_satuan) }}"
                       required>
            </div>

            <hr>

            <div class="text-center">
                <button class="btn btn-primary">
                    <i class="la la-save"></i> Update
                </button>
                <a href="{{ route('barang_masuk.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
