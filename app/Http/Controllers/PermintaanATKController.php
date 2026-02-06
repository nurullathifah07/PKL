<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermintaanATKController extends Controller
{
    /*
    =========================
    RIWAYAT PERMINTAAN
    =========================
    */
    public function index()
    {
        $pegawai = Auth::user()->pegawai;

        $riwayat = BarangKeluar::with('details.barang')
            ->where('id_pegawai', $pegawai->id_pegawai)
            ->orderBy('tanggal_keluar', 'desc')
            ->get();

        return view('pegawai.permintaan-ATK.index', compact('riwayat'));
    }


    /*
    =========================
    FORM PERMINTAAN
    =========================
    */
    public function create()
    {
        $barang = Barang::orderBy('nama_barang')->get();

        return view('pegawai.permintaan-ATK.create', compact('barang'));
    }


    /*
    =========================
    SIMPAN PERMINTAAN
    =========================
    */
    public function store(Request $request)
    {
        $pegawai = Auth::user()->pegawai;

        $request->validate([
            'barang.*.id_barang'     => 'required|exists:barang,id_barang',
            'barang.*.jumlah_keluar' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request, $pegawai) {

                $today = now()->toDateString();

                $barangKeluar = BarangKeluar::where('tanggal_keluar', $today)
                    ->where('id_pegawai', $pegawai->id_pegawai)
                    ->first();

                if (!$barangKeluar) {
                    $barangKeluar = BarangKeluar::create([
                        'tanggal_keluar' => $today,
                        'id_pegawai'     => $pegawai->id_pegawai,
                        'keterangan'     => $request->keterangan,
                    ]);
                }

                foreach ($request->barang as $item) {

                    $barang = Barang::lockForUpdate()->find($item['id_barang']);

                    if ($barang->stok < $item['jumlah_keluar']) {
                        throw new \Exception('Stok '.$barang->nama_barang.' tidak cukup');
                    }

                    BarangKeluarDetail::create([
                        'id_barang_keluar' => $barangKeluar->id_barang_keluar,
                        'id_barang'        => $item['id_barang'],
                        'jumlah_keluar'    => $item['jumlah_keluar'],
                    ]);

                    $barang->stok -= $item['jumlah_keluar'];
                    $barang->save();
                }
            });

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()
            ->route('permintaan-ATK.index')
            ->with('success', 'Permintaan berhasil dikirim');
    }


    /*
    =========================
    DETAIL / SHOW
    =========================
    */
    public function show(BarangKeluar $permintaan_ATK)
    {
        $pegawaiLogin = Auth::user()->pegawai;

        // keamanan
        if ($permintaan_ATK->id_pegawai != $pegawaiLogin->id_pegawai) {
            abort(403);
        }

        $permintaan_ATK->load([
            'details.barang',
            'pegawai'
        ]);

        $pejabatMengetahui = Pegawai::where('jabatan', 'Kepala Subbagian Umum')->first();

        return view('pegawai.permintaan-ATK.show', [
            'barangKeluar' => $permintaan_ATK,
            'pejabatMengetahui' => $pejabatMengetahui
        ]);
    }
}
