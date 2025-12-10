@extends('layout.admin_layout')

@section('title', 'Tambah Daftar Barang Keluar')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Input Barang Keluar Baru</h6>
    </div>
    <div class="card-body">
        <form action="proses_tambah_barang_keluar.php" method="POST">

            <div class="row mb-3">
                <label for="namaPegawai" class="col-sm-3 col-form-label">Nama Pegawai <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <select class="form-select" id="namaPegawai" name="nama_pegawai" required>
                        <option value="" disabled selected>-- Pilih Pegawai --</option>
                        <option value="Hizrian">Hizrian</option>
                        <option value="M.Otto">M.Otto</option>
                        <option value="Fulan">Fulan</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="namaBarang" class="col-sm-3 col-form-label">Nama Barang <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <select class="form-select" id="namaBarang" name="nama_barang" required>
                        <option value="" disabled selected>-- Pilih Barang --</option>
                        <option value="Pen Kenko K.1 Hitam">Pen Kenko K.1 Hitam (Stok: 50)</option>
                        <option value="Pen Kenko K.1 Biru">Pen Kenko K.1 Biru (Stok: 35)</option>
                        <option value="Kertas HVS A4">Kertas HVS A4 (Stok: 10)</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="jumlahBarang" class="col-sm-3 col-form-label">Jumlah Barang <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="jumlahBarang" name="jumlah_barang" min="1" required placeholder="Masukkan jumlah barang yang dikeluarkan">
                </div>
            </div>

            <div class="row mb-3">
                <label for="tanggalKeluar" class="col-sm-3 col-form-label">Tanggal Keluar <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="tanggalKeluar" name="tanggal_keluar" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="keterangan" class="col-sm-3 col-form-label">Keterangan (Opsional)</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Contoh: Digunakan untuk kebutuhan rapat divisi A"></textarea>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('admin.barang_keluar') }}" class="btn btn-secondary">Batal</a>
            </div>
            </div>
        </form>
    </div>
</div>

@endsection
