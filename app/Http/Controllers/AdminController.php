<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluarDetail;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // ================= BERANDA ADMIN =================
    public function dashboard()
    {
        // Total barang (item unik)
        $totalBarang = Barang::count();

        // Total transaksi barang keluar
        $totalBarangKeluar = BarangKeluarDetail::sum('jumlah_keluar');

        // Total transaksi barang masuk
        $totalBarangMasuk = BarangMasuk::sum('jumlah_barang');

        // Stok menipis (misal <= 10)
        $stokMenipis = Barang::where('stok', '<=', 10)->get();

        // Rekap pengambilan barang per hari
        $grafikPengambilan = BarangKeluarDetail::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(jumlah_keluar) as total')
            )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tanggal', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalBarang',
            'totalBarangKeluar',
            'totalBarangMasuk',
            'stokMenipis',
            'grafikPengambilan'
        ));
    }
}
