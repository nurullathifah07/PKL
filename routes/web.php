<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    AkunController,
    AuthController,
    BarangController,
    BarangKeluarController,
    BarangMasukController,
    KartuPersediaanController,
    OperatorController,
    PegawaiController,
    PegawaiViewController,
    PermintaanATKController,
    ProfilController,
    UsulanBarangController
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

Route::get('/clear-notif/{total}', function ($total) {
    session(['last_cleared_total' => $total]);
    return redirect()->back();
})->name('notif.clear');


/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'level:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('/akun', AkunController::class);
    Route::resource('/pegawai', PegawaiController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/barang_masuk', BarangMasukController::class);
    Route::resource('/barang_keluar', BarangKeluarController::class);
    Route::get('/kartu_persediaan',[KartuPersediaanController::class, 'index'])->name('kartu_persediaan.index');
    Route::get('/kartu_persediaan/{id}',[KartuPersediaanController::class, 'show'])->name('kartu_persediaan.show');
    Route::get('/usulan_barang',[UsulanBarangController::class,'index'])->name('usulan_barang.index');
    Route::get('/usulan_barang/{id}/setujui',[UsulanBarangController::class,'setujui'])->name('usulan_barang.setujui');
    Route::post('/usulan_barang/{id}/tolak', [UsulanBarangController::class,'tolak'])->name('usulan_barang.tolak');
    Route::post('/usulan_barang/{id}/simpan-barang',[UsulanBarangController::class,'simpanBarang'])->name('usulan_barang.simpanBarang');
    Route::delete('/usulan_barang/{id}', [UsulanBarangController::class, 'destroy'])->name('usulan_barang.destroy');
});


/*
|--------------------------------------------------------------------------
| PEGAWAI ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'level:pegawai'])->prefix('pegawai')->group(function () {

    Route::get('/dashboard', [PegawaiViewController::class, 'dashboard'])->name('pegawai.dashboard');
    Route::resource('/permintaan-ATK', PermintaanATKController::class);
    Route::get('/usulan_barang',[UsulanBarangController::class,'index'])->name('pegawai.usulan_barang.index');
    Route::get('/usulan_barang/create',[UsulanBarangController::class,'create'])->name('pegawai.usulan_barang.create');
    Route::post('/usulan_barang/store',[UsulanBarangController::class,'store'])->name('pegawai.usulan_barang.store');
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
    Route::get('/kartu_persediaan',[KartuPersediaanController::class, 'index'])->name('kartu_persediaan.index');
    Route::get('/kartu_persediaan/{id}',[KartuPersediaanController::class, 'show'])->name('kartu_persediaan.show');
    Route::get('/usulan_barang',[UsulanBarangController::class,'index'])->name('usulan_barang.index');
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
