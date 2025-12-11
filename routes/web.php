<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AkunController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Auth
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});


//Admin
Route::get('/admin/beranda', [AdminController::class, 'beranda'])->name('admin.beranda');

Route::get('/admin/profil', [AdminController::class, 'profil'])->name('admin.profil');
Route::get('/admin/profil_edit', [AdminController::class, 'profil_edit'])->name('admin.profil_edit');


Route::get('/admin/akun', [AdminController::class, 'akun'])->name('admin.akun');
Route::get('/admin/akun_tambah', [AdminController::class, 'akun_tambah'])->name('admin.akun_tambah');
Route::get('/admin/akun_edit', [AdminController::class, 'akun_edit'])->name('admin.akun_edit');

Route::get('/admin/pegawai', [AdminController::class, 'pegawai'])->name('admin.pegawai');
Route::get('/admin/pegawai_tambah', [AdminController::class, 'pegawai_tambah'])->name('admin.pegawai_tambah');

Route::get('/admin/barang', [AdminController::class, 'barang'])->name('admin.barang');
Route::get('/admin/barang_tambah', [AdminController::class, 'barang_tambah'])->name('admin.barang_tambah');

Route::get('/admin/barang_masuk', [AdminController::class, 'barang_masuk'])->name('admin.barang_masuk');
Route::get('/admin/barang_masuk_tambah', [AdminController::class, 'barang_masuk_tambah'])->name('admin.barang_masuk_tambah');

Route::get('/admin/barang_keluar', [AdminController::class, 'barang_keluar'])->name('admin.barang_keluar');
Route::get('/admin/barang_keluar_tambah', [AdminController::class, 'barang_keluar_tambah'])->name('admin.barang_keluar_tambah');


Route::get('/admin/notifikasi', [AdminController::class, 'notifikasi'])->name('admin.notifikasi');
