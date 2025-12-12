@extends('layout.admin_layout')

@section('title', 'Edit Barang')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Form Edit Barang</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.barang') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" placeholder="Contoh: 4.01.03.996.999" required>
                @error('kode_barang')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Contoh: Pen Kenko K.1 Hitam" required>
                @error('nama_barang')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" class="form-control" id="satuan" name="satuan" value="{{ old('satuan') }}" placeholder="Contoh: Buah, Lusin, Kotak" required>
                @error('satuan')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stok_minimal" class="form-label">Stok Minimal</label>
                <input type="number" class="form-control" id="stok_minimal" name="stok_minimal" value="{{ old('stok_minimal') }}" placeholder="Contoh: 6" required min="0">
                <small class="form-text text-muted">Stok minimal sebagai batas pemberitahuan jika barang mulai habis.</small>
                @error('stok_minimal')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary me-2">Update</button>
                <a href="{{ route('admin.barang') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection

