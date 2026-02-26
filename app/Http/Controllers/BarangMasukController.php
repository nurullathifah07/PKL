<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    /*
    |--------------------------------------------------
    | HELPER
    |--------------------------------------------------
    */

    private function level()
    {
        return Auth::user()->level; // admin / operator
    }

    private function viewPath($view)
    {
        return $this->level() . '.barang_masuk.' . $view;
    }

    private function indexRoute()
    {
        return $this->level() === 'operator'
            ? 'operator.barang_masuk.index'
            : 'admin.barang_masuk.index';
    }

    /*
    |--------------------------------------------------
    | INDEX
    |--------------------------------------------------
    */
    public function index()
    {
        $barangMasuk = BarangMasuk::with('barang')
            ->orderBy('tanggal_pembelian', 'desc')
            ->get();

        return view($this->viewPath('index'), compact('barangMasuk'));
    }

    /*
    |--------------------------------------------------
    | CREATE
    |--------------------------------------------------
    */
    public function create()
    {
        $barang = Barang::orderBy('nama_barang')->get();
        return view($this->viewPath('create'), compact('barang'));
    }

    /*
    |--------------------------------------------------
    | STORE
    |--------------------------------------------------
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

            BarangMasuk::create([
                'id_barang'         => $request->id_barang,
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'jumlah_barang'     => $request->jumlah_barang,
                'harga_satuan'      => $request->harga_satuan,
                'total_harga'       => $request->jumlah_barang * $request->harga_satuan,
            ]);

            $barang = Barang::findOrFail($request->id_barang);
            $barang->stok += $request->jumlah_barang;
            $barang->save();
        });

        return redirect()
            ->route($this->indexRoute())
            ->with('success', 'Barang berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------
    | EDIT
    |--------------------------------------------------
    */
    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barang = Barang::orderBy('nama_barang')->get();

        return view($this->viewPath('edit'), compact('barangMasuk', 'barang'));
    }

    /*
    |--------------------------------------------------
    | UPDATE
    |--------------------------------------------------
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

            // rollback stok lama
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
            ->route($this->indexRoute())
            ->with('success', 'Data barang masuk berhasil diperbarui');
    }

    /*
    |--------------------------------------------------
    | DESTROY
    |--------------------------------------------------
    */
    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barang = Barang::findOrFail($barangMasuk->id_barang);

        DB::transaction(function () use ($barangMasuk, $barang) {

            // kurangi stok
            $barang->stok -= $barangMasuk->jumlah_barang;
            $barang->save();

            // hapus data
            $barangMasuk->delete();
        });

        return redirect()
            ->route($this->indexRoute())
            ->with('success', 'Data barang masuk berhasil dihapus');
    }
}
