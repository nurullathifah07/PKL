<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\PegawaiController;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Pegawai;
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

//Admin//Akun
Route::resource('/admin/akun', AkunController::class);
//Admin//Pegawai
Route::resource('/admin/pegawai', PegawaiController::class);

//Admin//Barang
Route::resource('/admin/barang', BarangController::class);

//Admin//Barang Masuk
Route::resource('/admin/barang_masuk', BarangMasukController::class);

Route::get('/admin/barang_keluar', [AdminController::class, 'barang_keluar'])->name('admin.barang_keluar');
Route::get('/admin/barang_keluar_tambah', [AdminController::class, 'barang_keluar_tambah'])->name('admin.barang_keluar_tambah');
Route::get('/admin/barang_keluar_edit', [AdminController::class, 'barang_keluar_edit'])->name('admin.barang_keluar_edit');


Route::get('/admin/notifikasi', [AdminController::class, 'notifikasi'])->name('admin.notifikasi');
