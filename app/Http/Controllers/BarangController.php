<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    private function viewPath($view)
    {
        $level = Auth::user()->level; // admin / operator
        return "$level.barang.$view";
    }

    private function routeName($name)
    {
        return Auth::user()->level . ".barang.$name";
    }

    // INDEX
    public function index()
    {
        $barang = Barang::all();
        return view($this->viewPath('index'), compact('barang'));
    }

    // CREATE
    public function create()
    {
        return view($this->viewPath('create'));
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

        $status = match (true) {
            $stok == 0 => 'habis',
            $stok <= $request->stok_minimal => 'menipis',
            default => 'tersedia',
        };

        Barang::create([
            'kode_barang'  => $request->kode_barang,
            'nama_barang'  => $request->nama_barang,
            'satuan'       => $request->satuan,
            'stok_minimal' => $request->stok_minimal,
            'stok'         => $stok,
            'status'       => $status,
        ]);

        return redirect()
            ->route($this->routeName('index'))
            ->with('success', 'Barang berhasil ditambahkan');
    }

    // EDIT
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view($this->viewPath('edit'), compact('barang'));
    }

    // UPDATE
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

        $status = match (true) {
            $stok == 0 => 'habis',
            $stok <= $request->stok_minimal => 'menipis',
            default => 'tersedia',
        };

        $barang->update([
            'kode_barang'  => $request->kode_barang,
            'nama_barang'  => $request->nama_barang,
            'satuan'       => $request->satuan,
            'stok_minimal' => $request->stok_minimal,
            'stok'         => $stok,
            'status'       => $status,
        ]);

        return redirect()
            ->route($this->routeName('index'))
            ->with('success', 'Barang berhasil diperbarui');
    }

    // DELETE
    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();

        return redirect()
            ->route($this->routeName('index'))
            ->with('success', 'Barang berhasil dihapus');
    }
}
