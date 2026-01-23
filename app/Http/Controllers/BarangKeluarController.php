<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pegawai;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    /**
     * ===============================
     * INDEX
     * ===============================
     */
    public function index()
    {
        $barangKeluar = BarangKeluar::with('pegawai')
            ->orderBy('tanggal_keluar', 'desc')
            ->get();

        return view('admin.barang_keluar.index', compact('barangKeluar'));
    }

    /**
     * ===============================
     * CREATE
     * ===============================
     */
    public function create()
    {
        $barang  = Barang::orderBy('nama_barang')->get();
        $pegawai = Pegawai::orderBy('nama_pegawai')->get();

        return view('admin.barang_keluar.create', compact('barang', 'pegawai'));
    }

    /**
     * ===============================
     * STORE
     * ===============================
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_keluar'         => 'required|date',
            'id_pegawai'             => 'required|exists:pegawai,id_pegawai',
            'keterangan'             => 'nullable|string',
            'barang.*.id_barang'     => 'required|exists:barang,id_barang',
            'barang.*.jumlah_keluar' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {

                // 🔍 cek bon pegawai di hari yang sama
                $barangKeluar = BarangKeluar::where('tanggal_keluar', $request->tanggal_keluar)
                    ->where('id_pegawai', $request->id_pegawai)
                    ->first();

                // ➕ jika belum ada → buat bon
                if (!$barangKeluar) {
                    $barangKeluar = BarangKeluar::create([
                        'tanggal_keluar' => $request->tanggal_keluar,
                        'id_pegawai'     => $request->id_pegawai,
                        'keterangan'     => $request->keterangan,
                    ]);
                }

                // 🧾 simpan detail barang
                foreach ($request->barang as $item) {

                    $barang = Barang::lockForUpdate()->findOrFail($item['id_barang']);

                    if ($barang->stok < $item['jumlah_keluar']) {
                        throw new \Exception(
                            'Stok ' . $barang->nama_barang . ' tidak mencukupi'
                        );
                    }

                    BarangKeluarDetail::create([
                        'id_barang_keluar' => $barangKeluar->id_barang_keluar,
                        'id_barang'        => $item['id_barang'],
                        'jumlah_keluar'    => $item['jumlah_keluar'],
                    ]);

                    // kurangi stok
                    $barang->stok -= $item['jumlah_keluar'];
                    $barang->save();
                }
            });

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('barang_keluar.index')
            ->with('success', 'Barang keluar berhasil disimpan');
    }

    /**
     * ===============================
     * SHOW
     * ===============================
     */
    public function show($id)
{
    $barangKeluar = BarangKeluar::with([
        'pegawai',
        'details.barang'
    ])->findOrFail($id);

    // 🔍 pejabat yang mengetahui (otomatis)
    $pejabatMengetahui = Pegawai::where('jabatan', 'Kepala Subbagian Umum')
        ->first();

    return view(
        'admin.barang_keluar.show',
        compact('barangKeluar', 'pejabatMengetahui')
    );
}


    /**
     * ===============================
     * EDIT
     * ===============================
     */
    public function edit($id)
    {
        $barangKeluar = BarangKeluar::with('details.barang')->findOrFail($id);
        $barang = Barang::orderBy('nama_barang')->get();

        return view('admin.barang_keluar.edit', compact('barangKeluar', 'barang'));
    }

    /**
     * ===============================
     * UPDATE
     * ===============================
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'barang.*.id_detail_bk'  => 'required|exists:barang_keluar_detail,id_detail_bk',
            'barang.*.id_barang'     => 'required|exists:barang,id_barang',
            'barang.*.jumlah_keluar' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {

                $barangKeluar = BarangKeluar::with('details')->findOrFail($id);

                foreach ($request->barang as $item) {

                    $detail = BarangKeluarDetail::findOrFail($item['id_detail_bk']);
                    $barang = Barang::lockForUpdate()->findOrFail($item['id_barang']);

                    // kembalikan stok lama
                    $barang->stok += $detail->jumlah_keluar;

                    if ($barang->stok < $item['jumlah_keluar']) {
                        throw new \Exception(
                            'Stok ' . $barang->nama_barang . ' tidak mencukupi'
                        );
                    }

                    // update detail
                    $detail->update([
                        'jumlah_keluar' => $item['jumlah_keluar']
                    ]);

                    // kurangi stok baru
                    $barang->stok -= $item['jumlah_keluar'];
                    $barang->save();
                }
            });

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('barang_keluar.show', $id)
            ->with('success', 'Bon berhasil diperbarui');
    }

    /**
     * ===============================
     * DESTROY
     * ===============================
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $barangKeluar = BarangKeluar::with('details')->findOrFail($id);

            foreach ($barangKeluar->details as $detail) {
                $barang = Barang::find($detail->id_barang);
                $barang->stok += $detail->jumlah_keluar;
                $barang->save();
            }

            $barangKeluar->delete();
        });

        return redirect()
            ->route('barang_keluar.index')
            ->with('success', 'Data barang keluar berhasil dihapus');
    }
}
