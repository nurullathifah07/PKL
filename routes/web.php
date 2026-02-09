<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    AkunController,
    AuthController,
    BarangController,
    BarangKeluarController,
    BarangMasukController,
    OperatorController,
    PegawaiController,
    PegawaiViewController,
    PermintaanATKController,
    ProfilController
};

/*
|--------------------------------------------------------------------------
| AUTH (bebas akses)
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', fn() => view('auth.register'));


/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'level:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('/akun', AkunController::class);
    Route::resource('/pegawai', PegawaiController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/barang_masuk', BarangMasukController::class);
    Route::resource('/barang_keluar', BarangKeluarController::class);

    Route::get('/notifikasi', [AdminController::class, 'notifikasi'])->name('admin.notifikasi');
});


/*
|--------------------------------------------------------------------------
| PEGAWAI ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'level:pegawai'])->prefix('pegawai')->group(function () {

    Route::get('/dashboard', [PegawaiViewController::class, 'dashboard'])->name('pegawai.dashboard');

    Route::resource('/permintaan-ATK', PermintaanATKController::class);
});


/*
|--------------------------------------------------------------------------
| OPERATOR ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'level:operator'])->prefix('operator')->name('operator.')->group(function () {

    Route::get('/dashboard', [OperatorController::class, 'dashboard'])->name('dashboard');

    Route::resource('/barang', BarangController::class);
    Route::resource('/barang_masuk', BarangMasukController::class);
    Route::resource('/barang_keluar', BarangKeluarController::class);

    Route::get('/notifikasi', [OperatorController::class, 'notifikasi'])->name('notifikasi');
});


/*
|--------------------------------------------------------------------------
| PROFIL (pegawai + operator)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'level:pegawai,operator'])->group(function () {

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
});
