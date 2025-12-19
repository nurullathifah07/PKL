<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    /**
     * 1. TAMPIL DATA
     */
    public function index()
    {
        $barangMasuk = BarangMasuk::with('barang')
            ->orderBy('tanggal_pembelian', 'desc')
            ->get();

        return view('admin.barang_masuk.index', compact('barangMasuk'));
    }

    /**
     * 2. FORM TAMBAH
     */
    public function create()
    {
        $barang = Barang::orderBy('nama_barang')->get();
        return view('admin.barang_masuk.create', compact('barang'));
    }

    /**
     * 3. SIMPAN DATA + UPDATE STOK
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_barang'         => 'required|exists:barang,id_barang',
            'tanggal_pembelian' => 'required|date',
            'jumlah_barang'     => 'required|integer|min:1',
            'harga_satuan'      => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request) {

            // simpan barang masuk
            BarangMasuk::create([
                'id_barang'         => $request->id_barang,
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'jumlah_barang'     => $request->jumlah_barang,
                'harga_satuan'      => $request->harga_satuan,
                'total_harga'       => $request->jumlah_barang * $request->harga_satuan,
            ]);

            // update stok barang
            $barang = Barang::findOrFail($request->id_barang);
            $barang->stok += $request->jumlah_barang;
            $barang->save();
        });

        return redirect()
            ->route('barang_masuk.index')
            ->with('success', 'Barang masuk berhasil ditambahkan');
    }

    /**
     * 4. FORM EDIT
     */
    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barang = Barang::all();

        return view('admin.barang_masuk.edit', compact('barangMasuk', 'barang'));
    }

    /**
     * 5. UPDATE DATA + KOREKSI STOK
     */
    public function update(Request $request, $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barang = Barang::findOrFail($barangMasuk->id_barang);

        $request->validate([
            'tanggal_pembelian' => 'required|date',
            'jumlah_barang'     => 'required|integer|min:1',
            'harga_satuan'      => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request, $barangMasuk, $barang) {

            // kembalikan stok lama
            $barang->stok -= $barangMasuk->jumlah_barang;

            // update data
            $barangMasuk->update([
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'jumlah_barang'     => $request->jumlah_barang,
                'harga_satuan'      => $request->harga_satuan,
                'total_harga'       => $request->jumlah_barang * $request->harga_satuan,
            ]);

            // tambah stok baru
            $barang->stok += $request->jumlah_barang;
            $barang->save();
        });

        return redirect()
            ->route('barang_masuk.index')
            ->with('success', 'Data barang masuk berhasil diperbarui');
    }

    /**
     * 6. HAPUS DATA + KEMBALIKAN STOK
     */
    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barang = Barang::findOrFail($barangMasuk->id_barang);

        DB::transaction(function () use ($barangMasuk, $barang) {

            // kembalikan stok
            $barang->stok -= $barangMasuk->jumlah_barang;
            $barang->save();

            // hapus data
            $barangMasuk->delete();
        });

        return redirect()
            ->route('barang_masuk.index')
            ->with('success', 'Data barang masuk berhasil dihapus');
    }
}
