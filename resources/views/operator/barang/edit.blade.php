@extends('layout.operator_layout')

@section('title', 'Edit Barang')

@section('content')

<h4 class="page-title">Edit Barang</h4>

<div class="card shadow">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Edit Data Barang</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('operator.barang.update', $barang->id_barang) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- KODE BARANG --}}
            <div class="mb-3">
                <label>Kode Barang</label>
                <input type="text"
                       name="kode_barang"
                       class="form-control"
                       value="{{ old('kode_barang', $barang->kode_barang) }}"
                       required>
            </div>

            {{-- NAMA BARANG --}}
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text"
                       name="nama_barang"
                       class="form-control"
                       value="{{ old('nama_barang', $barang->nama_barang) }}"
                       required>
            </div>

            {{-- SATUAN --}}
            <div class="mb-3">
                <label>Satuan</label>
                <select name="satuan" class="form-select" required>
                    <option value="buah" {{ $barang->satuan == 'buah' ? 'selected' : '' }}>Buah</option>
                    <option value="box"  {{ $barang->satuan == 'box' ? 'selected' : '' }}>Box</option>
                    <option value="rim"  {{ $barang->satuan == 'rim' ? 'selected' : '' }}>Rim</option>
                </select>
            </div>

            {{-- STOK MINIMAL --}}
            <div class="mb-3">
                <label>Stok Minimal</label>
                <input type="number"
                       name="stok_minimal"
                       class="form-control"
                       value="{{ old('stok_minimal', $barang->stok_minimal) }}"
                       min="0"
                       required>
            </div>

            {{-- STOK --}}
            <div class="mb-3">
                <label>Stok Saat Ini</label>
                <input type="number"
                       name="stok"
                       class="form-control"
                       value="{{ old('stok', $barang->stok) }}"
                       min="0">
                <small class="text-muted">
                    Boleh dikosongkan (stok tidak berubah)
                </small>
            </div>

            <hr>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('operator.barang.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
