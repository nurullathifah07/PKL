@extends('layout.admin_layout')

@section('title', 'Tambah Barang')

@section('content')

<h4 class="page-title">Tambah Barang</h4>
<hr>

<div class="card shadow">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Tambah Data Barang</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf

            {{-- KODE BARANG --}}
            <div class="mb-3">
                <label class="form-label">Kode Barang</label>
                <input type="text"
                       name="kode_barang"
                       class="form-control @error('kode_barang') is-invalid @enderror"
                       value="{{ old('kode_barang') }}"
                       placeholder="Contoh: 4.01.03.996.999"
                       required>

                @error('kode_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- NAMA BARANG --}}
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text"
                       name="nama_barang"
                       class="form-control @error('nama_barang') is-invalid @enderror"
                       value="{{ old('nama_barang') }}"
                       required>

                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- SATUAN --}}
            <div class="mb-3">
                <label class="form-label">Satuan</label>
                <select name="satuan"
                        class="form-select @error('satuan') is-invalid @enderror"
                        required>
                    <option value="">Pilih Satuan</option>
                    <option value="buah" {{ old('satuan') == 'buah' ? 'selected' : '' }}>Buah</option>
                    <option value="box"  {{ old('satuan') == 'box' ? 'selected' : '' }}>Box</option>
                    <option value="rim"  {{ old('satuan') == 'rim' ? 'selected' : '' }}>Rim</option>
                </select>

                @error('satuan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- STOK MINIMAL --}}
            <div class="mb-3">
                <label class="form-label">Stok Minimal</label>
                <input type="number"
                       name="stok_minimal"
                       class="form-control @error('stok_minimal') is-invalid @enderror"
                       value="{{ old('stok_minimal') }}"
                       min="0"
                       required>

                <small class="text-muted">
                    Digunakan sebagai batas peringatan stok menipis
                </small>

                @error('stok_minimal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- STOK AWAL (OPSIONAL) --}}
            <div class="mb-3">
                <label class="form-label">
                    Stok Awal <span class="text-muted">(Opsional)</span>
                </label>

                <input type="number"
                       name="stok"
                       class="form-control @error('stok') is-invalid @enderror"
                       value="{{ old('stok') }}"
                       min="0"
                       placeholder="Kosongkan jika belum ada stok">

                <small class="text-muted">
                    Jika tidak diisi, stok otomatis bernilai <b>0</b>
                </small>

                @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            {{-- TOMBOL --}}
            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
