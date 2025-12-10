@extends('layout.admin_layout')

@section('title', 'Edit Akun')

@section('content')

<h4 class="page-title">Edit Akun</h4>
<hr>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit Data Akun Pengguna</h6>
    </div>
    <div class="card-body">

        <form id="formEditAkun" action="{{ url('/admin/akun/update/ID_AKUN') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="editUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="editUsername" name="username"
                    placeholder="Masukkan Username" value="{{ $akun->username ?? 'hizrian_lama' }}" required>
            </div>

            <div class="mb-3">
                <label for="editEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="editEmail" name="email"
                    placeholder="Masukkan Email" value="{{ $akun->email ?? 'hizrian@example.com' }}" required>
            </div>

            <div class="mb-3">
                <label for="editLevel" class="form-label">Level Akun</label>
                <select class="form-select" id="editLevel" name="level" required>
                    <option value="Administrator" {{ ($akun->level ?? 'Administrator') == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                    <option value="User Biasa" {{ ($akun->level ?? 'Administrator') == 'User Biasa' ? 'selected' : '' }}>User Biasa</option>
                </select>
            </div>

            <hr>
            <p class="text-danger">Kosongkan kolom di bawah ini jika tidak ingin mengubah password.</p>

            <div class="mb-3">
                <label for="editPassword" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="editPassword" name="password"
                    placeholder="Isi jika ingin mengganti password">
            </div>

            <div class="mb-3">
                <label for="editKonfirmasiPassword" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="editKonfirmasiPassword" name="password_confirmation"
                    placeholder="Ulangi Password Baru">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary me-2">Update</button>
                <a href="{{ route('admin.akun') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
