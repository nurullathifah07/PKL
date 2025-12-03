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


Route::get('/admin/akun', [AdminController::class, 'akun'])->name('admin.akun');

Route::get('/admin/pegawai', [AdminController::class, 'pegawai'])->name('admin.pegawai');

Route::get('/admin/barang', [AdminController::class, 'barang'])->name('admin.barang');


