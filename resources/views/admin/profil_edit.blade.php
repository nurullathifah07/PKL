@extends('layout.admin_layout')

@section('title', 'Edit Profil Pengguna')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Profil</h6>
            </div>
            <div class="card-body">

                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <img src="{{ asset('assets/img/profile.jpg') }}"
                                alt="user" class="img-fluid rounded-circle profile-img mb-3"
                                style="width: 150px; height: 150px; object-fit: cover;">

                            <h5 class="mt-3">Hizrian Fulan</h5>
                            <p class="text-muted">Administrator</p>

                            <div class="form-group mt-3">
                                <label for="foto_profil">Ubah Foto</label>
                                <input type="file" class="form-control-file" id="foto_profil" name="foto_profil">
                                <small class="form-text text-muted">Maks. 2MB, format JPG/PNG.</small>
                            </div>
                        </div>

                        <div class="col-md-8">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                       value="hizrian" required>
                            </div>

                            <div class="form-group">
                                <label for="nama_pegawai">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai"
                                       value="Hizrian Fulan" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="hizrian@example.com" required>
                            </div>

                            <div class="form-group">
                                <label for="level">Level Akses</label>
                                <input type="text" class="form-control" id="level" value="Administrator" disabled>
                                <small class="form-text text-danger">Level akses hanya dapat diubah oleh Super Admin.</small>
                            </div>

                            <hr>

                            <h6 class="text-secondary mt-4 mb-3">Ganti Password (Opsional)</h6>

                            <div class="form-group">
                                <label for="password_baru">Password Baru</label>
                                <input type="password" class="form-control" id="password_baru" name="password_baru">
                            </div>

                            <div class="form-group">
                                <label for="konfirmasi_password">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                            </div>

                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-right">
                            <a href="{{ url('admin/profil') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
