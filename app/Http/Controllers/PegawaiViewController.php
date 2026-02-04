<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
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

        $totalBarang = Barang::count();
        $totalBarangKeluar = BarangKeluarDetail::sum('jumlah_keluar');
        $totalBarangMasuk = BarangMasuk::sum('jumlah_barang');

        $stokMenipis = Barang::where('stok', '<=', 10)
            ->orderBy('stok', 'asc')
            ->limit(10)
            ->get();

        $grafikPengambilan = BarangKeluarDetail::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(jumlah_keluar) as total')
            )
            ->where('created_at', '>=', now()->subDays(10))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('pegawai.dashboard', compact(
            'akun',
            'pegawai',
            'totalBarang',
            'totalBarangKeluar',
            'totalBarangMasuk',
            'stokMenipis',
            'grafikPengambilan'
        ));
    }

}
