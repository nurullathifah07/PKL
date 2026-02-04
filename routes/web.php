<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PegawaiViewController;
use App\Http\Controllers\ProfilController;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Route;


// Auth
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/register', function () {
    return view('auth.register');
});


Route::middleware(['auth'])->group(function () {

    // ADMIN
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/profil', [AdminController::class, 'profil'])
        ->name('admin.profil');

    Route::get('/admin/profil_edit', [AdminController::class, 'profil_edit'])
        ->name('admin.profil_edit');

    Route::resource('/admin/akun', AkunController::class);
    Route::resource('/admin/pegawai', PegawaiController::class);
    Route::resource('/admin/barang', BarangController::class);
    Route::resource('/admin/barang_masuk', BarangMasukController::class);
    Route::resource('/admin/barang_keluar', BarangKeluarController::class);

    Route::get('/admin/notifikasi', [AdminController::class, 'notifikasi'])
        ->name('admin.notifikasi');

    // PEGAWAI
    Route::get('/pegawai/dashboard', [PegawaiViewController::class, 'dashboard'])
        ->name('pegawai.dashboard');

    Route::get('/profil', [ProfilController::class, 'index'])
        ->name('profil.index');

    Route::get('/profil/edit', [ProfilController::class, 'edit'])
        ->name('profil.edit');

    Route::put('/profil', [ProfilController::class, 'update'])
        ->name('profil.update');
});



Route::get('/admin/notifikasi', [AdminController::class, 'notifikasi'])->name('admin.notifikasi');



