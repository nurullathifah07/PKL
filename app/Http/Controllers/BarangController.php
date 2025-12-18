<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // INDEX
    public function index()
    {
        $barang = Barang::all();
        return view('admin.barang.index', compact('barang'));
    }

    // CREATE
    public function create()
    {
        return view('admin.barang.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang'  => 'required|unique:barang,kode_barang',
            'nama_barang'  => 'required',
            'satuan'       => 'required|in:buah,box,rim',
            'stok_minimal' => 'required|integer|min:0',
            'stok'         => 'nullable|integer|min:0',
        ]);

        $stok = $request->stok ?? 0;

        // HITUNG STATUS OTOMATIS
        if ($stok == 0) {
            $status = 'habis';
        } elseif ($stok <= $request->stok_minimal) {
            $status = 'menipis';
        } else {
            $status = 'tersedia';
        }

        Barang::create([
            'kode_barang'  => $request->kode_barang,
            'nama_barang'  => $request->nama_barang,
            'satuan'       => $request->satuan,
            'stok_minimal' => $request->stok_minimal,
            'stok'         => $stok,
            'status'       => $status,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    // EDIT
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    // UPDATE (EDIT BARANG + STOK)
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'kode_barang'  => 'required|unique:barang,kode_barang,' . $barang->id_barang . ',id_barang',
            'nama_barang'  => 'required',
            'satuan'       => 'required|in:buah,box,rim',
            'stok_minimal' => 'required|integer|min:0',
            'stok'         => 'nullable|integer|min:0',
        ]);

        $stok = $request->stok ?? $barang->stok;

        // STATUS OTOMATIS
        if ($stok == 0) {
            $status = 'habis';
        } elseif ($stok <= $request->stok_minimal) {
            $status = 'menipis';
        } else {
            $status = 'tersedia';
        }

        $barang->update([
            'kode_barang'  => $request->kode_barang,
            'nama_barang'  => $request->nama_barang,
            'satuan'       => $request->satuan,
            'stok_minimal' => $request->stok_minimal,
            'stok'         => $stok,
            'status'       => $status,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    // DELETE
    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}
