<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\BarangKeluarDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PegawaiViewController extends Controller
{
    public function dashboard()
    {
        $akun = Auth::user();
        $pegawai = $akun->pegawai;

        // total stok semua barang (bukan count item, tapi jumlah stok)
        $totalBarang = Barang::count('id_barang');

        // jumlah permintaan milik pegawai ini saja
        $totalPermintaanSaya = BarangKeluar::where('id_pegawai', $pegawai->id)->count();

        // daftar semua barang + stok
        $barang = Barang::orderBy('nama_barang')->get();

        return view('pegawai.dashboard', compact(
            'akun',
            'pegawai',
            'totalBarang',
            'totalPermintaanSaya',
            'barang'
        ));
    }

}
