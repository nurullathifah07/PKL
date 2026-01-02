<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::orderBy('tanggal_keluar', 'desc')->get();
        return view('admin.barang_keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        $barang = Barang::orderBy('nama_barang')->get();
        return view('admin.barang_keluar.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_keluar'                => 'required|date',
            'nama_pemohon'                  => 'required|string',
            'keterangan'                    => 'nullable|string',
            'barang.*.id_barang'            => 'required|exists:barang,id_barang',
            'barang.*.jumlah_keluar'        => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {

                $barangKeluar = BarangKeluar::create([
                    'tanggal_keluar' => $request->tanggal_keluar,
                    'nama_pemohon'   => $request->nama_pemohon,
                    'keterangan'     => $request->keterangan,
                ]);

                foreach ($request->barang as $item) {

                    $barang = Barang::findOrFail($item['id_barang']);

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

    public function show($id)
    {
        $barangKeluar = BarangKeluar::with('details')->findOrFail($id);

        return view('admin.barang_keluar.show', compact('barangKeluar'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $barangKeluar = BarangKeluar::with('details')->findOrFail($id);

            foreach ($barangKeluar->details as $details) {
                $barang = Barang::findOrFail($details->id_barang);
                $barang->stok += $details->jumlah_keluar;
                $barang->save();
            }

            $barangKeluar->delete();
        });

        return redirect()
            ->route('barang_keluar.index')
            ->with('success', 'Data barang keluar berhasil dihapus');
    }
}
