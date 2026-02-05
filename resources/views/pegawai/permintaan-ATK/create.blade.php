@extends('layout.pegawai_layout')

@section('title', 'Ajukan Permintaan ATK')

@section('content')

<h4 class="page-title mb-4">Ajukan Permintaan ATK</h4>

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">
        <h5 class="mb-0">Form Permintaan Barang</h5>
    </div>

    <div class="card-body">

        {{-- 🔥 FIX DI SINI (route name diganti) --}}
        <form action="{{ route('permintaan-ATK.store') }}" method="POST">
            @csrf

            {{-- Pilih Barang --}}
            <div class="mb-3">
                <label class="form-label">Pilih Barang</label>
                <select name="barang[0][id_barang]" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barang as $b)
                        <option value="{{ $b->id_barang }}">
                            {{ $b->nama_barang }} (stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jumlah --}}
            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input
                    type="number"
                    name="barang[0][jumlah_keluar]"
                    class="form-control"
                    min="1"
                    placeholder="Masukkan jumlah"
                    required>
            </div>

            {{-- Keterangan --}}
            <div class="mb-3">
                <label class="form-label">Keterangan (opsional)</label>
                <textarea
                    name="keterangan"
                    class="form-control"
                    rows="3"></textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    Kirim Permintaan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
