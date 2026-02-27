@extends('layout.operator_layout')

@section('title', 'Tambah Barang Masuk')

@section('content')

<h4 class="page-title">Tambah Barang Masuk</h4>

<div class="card shadow mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Tambah Barang Masuk</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('operator.barang_masuk.store') }}" method="POST">
            @csrf

            {{-- NO BON --}}
            <div class="mb-3">
                <label class="form-label">No Bon</label>
                <input type="text"
                    name="no_bon"
                    class="form-control"
                    placeholder="Masukkan nomor bon (jika ada)"
                    value="{{ old('no_bon') }}">
            </div>
            
            {{-- TANGGAL --}}
            <div class="mb-3">
                <label class="form-label">Tanggal Pembelian</label>
                <input type="date"
                       name="tanggal_pembelian"
                       class="form-control"
                       value="{{ date('Y-m-d') }}"
                       required>
            </div>

            {{-- PILIH BARANG --}}
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <select name="id_barang" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barang as $b)
                        <option value="{{ $b->id_barang }}">
                            {{ $b->nama_barang }} ({{ $b->satuan }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- JUMLAH --}}
            <div class="mb-3">
                <label class="form-label">Jumlah Barang Masuk</label>
                <input type="number"
                       name="jumlah_barang"
                       class="form-control"
                       min="1"
                       required>
            </div>

            {{-- HARGA --}}
            <div class="mb-3">
                <label class="form-label">Harga Satuan (Rp)</label>
                <input type="number"
                       name="harga_satuan"
                       class="form-control"
                       min="0"
                       required>
            </div>

            <hr>

            <div class="text-center">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('operator.barang_masuk.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</div>

@endsection

