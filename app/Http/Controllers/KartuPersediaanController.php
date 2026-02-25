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

        return view('admin.kartu_persediaan.show', compact(
            'barang',
            'transaksi'
        ));
    }
}
