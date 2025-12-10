@extends('layout.admin_layout')

@section('title', 'Tambah Daftar Barang Masuk')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Input Barang Masuk Baru</h6>
    </div>
    <div class="card-body">
        <form action="{{ url('/admin/proses_barang_masuk') }}" method="POST">
            @csrf <div class="row mb-3">
                <label for="tanggalMasuk" class="col-sm-3 col-form-label">Tanggal Masuk</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="tanggalMasuk" name="tanggal_masuk"
                        value="{{ date('Y-m-d') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="namaBarang" class="col-sm-3 col-form-label">Nama Barang</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="namaBarang" name="nama_barang"
                        placeholder="Contoh: Sticky Notes" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="jumlahBarang" class="col-sm-3 col-form-label">Jumlah Barang</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="jumlahBarang" name="jumlah_barang"
                        min="1" placeholder="Masukkan jumlah" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="satuanBarang" class="col-sm-3 col-form-label">Satuan Barang</label>
                <div class="col-sm-9">
                    <select class="form-select" id="satuanBarang" name="satuan_barang" required>
                        <option value="" disabled selected>Pilih Satuan</option>
                        <option value="Buah">Buah</option>
                        <option value="Box">Box</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Rim">Rim</option>
                        <option value="Paket">Paket</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="hargaSatuan" class="col-sm-3 col-form-label">Harga Satuan (Rp)</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="hargaSatuan" name="harga_satuan"
                        min="0" placeholder="Contoh: 12000" required>
                    <div class="form-text">Masukkan harga tanpa titik/koma (angka bulat).</div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('admin.barang_masuk') }}" class="btn btn-secondary">Batal</a>
            </div>
            </div>
        </form>
    </div>
</div>

@endsection
