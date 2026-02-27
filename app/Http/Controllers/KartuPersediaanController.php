<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Barang;

class KartuPersediaanController extends Controller
{
    // =========================
    // INDEX → daftar barang
    // =========================
    public function index()
    {
        $barang = Barang::orderBy('nama_barang')->get();

        return view('admin.kartu_persediaan.index', compact('barang'));
    }

    // =========================
    // SHOW → kartu persediaan
    // =========================
    public function show($id)
    {
        $barang = Barang::findOrFail($id);

        /*
        ======================
        BARANG MASUK
        ======================
        */
        $masuk = DB::table('barang_masuk')
            ->where('id_barang', $id)
            ->select(
                'tanggal_pembelian as tanggal',
                DB::raw("'Pembelian' as uraian"),
                DB::raw('NULL as no_bon'),
                'harga_satuan',
                'jumlah_barang as masuk',
                DB::raw('0 as keluar')
            );

        /*
        ======================
        BARANG KELUAR
        ======================
        */
        $keluar = DB::table('barang_keluar_detail as d')
            ->join('barang_keluar as k', 'k.id_barang_keluar', '=', 'd.id_barang_keluar')
            ->where('d.id_barang', $id)
            ->select(
                'k.tanggal_keluar as tanggal',
                'k.keterangan as uraian',
                DB::raw('NULL as no_bon'),
                DB::raw('NULL as harga_satuan'),
                DB::raw('0 as masuk'),
                'd.jumlah_keluar as keluar'
            );

        /*
        ======================
        GABUNG TRANSAKSI
        ======================
        */
        $transaksi = $masuk
            ->unionAll($keluar)
            ->orderBy('tanggal')
            ->get();

        /*
        ======================
        HITUNG SALDO BERJALAN
        ======================
        */
        $saldo = 0;

        foreach ($transaksi as $t) {
            $saldo += $t->masuk;
            $saldo -= $t->keluar;
            $t->saldo = $saldo;
        }

        /*
        ======================
        REKAP BULANAN KELUAR
        ======================
        */
        $rekapBulanan = [];

        foreach ($transaksi as $t) {
            if ($t->keluar > 0) {
                $bulan = date('n', strtotime($t->tanggal));
                $rekapBulanan[$bulan] = ($rekapBulanan[$bulan] ?? 0) + $t->keluar;
            }
        }

        /*
        ======================
        TOTAL & STOK
        ======================
        */
        $jumlah_keluar = array_sum($rekapBulanan);

        $stokAwal = $transaksi->isNotEmpty()
            ? ($transaksi->first()->saldo - $transaksi->first()->masuk + $transaksi->first()->keluar)
            : 0;

        $stokAkhir = $transaksi->last()->saldo ?? 0;

        return view('admin.kartu_persediaan.show', compact(
            'barang',
            'transaksi',
            'rekapBulanan',
            'jumlah_keluar',
            'stokAwal',
            'stokAkhir'
        ));
    }
}
