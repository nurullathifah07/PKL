<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;

class KartuPersediaanController extends Controller
{
    private function viewPath($view)
    {
        $level = Auth::user()->level; // admin / operator
        return "$level.kartu_persediaan.$view";
    }

    private function routeName($name)
    {
        return Auth::user()->level . ".kartu_persediaan.$name";
    }

    // =========================
    // INDEX → daftar barang
    // =========================
    public function index()
    {
        $barang = Barang::orderBy('nama_barang')->get();
        return view($this->viewPath('index'), compact('barang'));
    }

    // =========================
    // SHOW → kartu persediaan
    // =========================
    public function show($id)
    {
        $barang = Barang::findOrFail($id);

        /*
        ======================
        BARANG MASUK (PEMBELIAN)
        ======================
        */
        $masuk = DB::table('barang_masuk')
            ->where('id_barang', $id)
            ->select(
                'tanggal_pembelian as tanggal',
                DB::raw("'Pembelian' as uraian"),
                'no_bon',
                'harga_satuan',
                'jumlah_barang as masuk',
                DB::raw('0 as keluar')
            );

        /*
        ======================
        BARANG KELUAR
        → uraian dari subbagian pegawai
        ======================
        */
        $keluar = DB::table('barang_keluar_detail as d')
            ->join('barang_keluar as k', 'k.id_barang_keluar', '=', 'd.id_barang_keluar')
            ->leftJoin('pegawai as p', 'p.id_pegawai', '=', 'k.id_pegawai')
            ->where('d.id_barang', $id)
            ->select(
                'k.tanggal_keluar as tanggal',
                'p.subbagian as uraian',
                DB::raw('NULL as no_bon'), // ✅ aman walau tidak ada di barang_keluar
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
                $rekapBulanan[$bulan] =
                    ($rekapBulanan[$bulan] ?? 0) + $t->keluar;
            }
        }

        /*
        ======================
        TOTAL & STOK
        ======================
        */
        $jumlah_keluar = array_sum($rekapBulanan);

        $stokAwal = $transaksi->isNotEmpty()
            ? ($transaksi->first()->saldo
                - $transaksi->first()->masuk
                + $transaksi->first()->keluar)
            : 0;

        $stokAkhir = $transaksi->last()->saldo ?? 0;

        return view($this->viewPath('show'), compact(
            'barang',
            'transaksi',
            'rekapBulanan',
            'jumlah_keluar',
            'stokAwal',
            'stokAkhir'
        ));
    }
}
