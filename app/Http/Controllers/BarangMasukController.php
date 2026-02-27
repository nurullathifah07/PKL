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
    public function index(Request $request)
    {
        $q = strtolower($request->q);

        // mapping bulan Indonesia
        $bulanMap = [
            'januari' => 1, 'jan' => 1,
            'februari' => 2, 'feb' => 2,
            'maret' => 3, 'mar' => 3,
            'april' => 4, 'apr' => 4,
            'mei' => 5,
            'juni' => 6, 'jun' => 6,
            'juli' => 7, 'jul' => 7,
            'agustus' => 8, 'agu' => 8,
            'september' => 9, 'sep' => 9,
            'oktober' => 10, 'okt' => 10,
            'november' => 11, 'nov' => 11,
            'desember' => 12, 'des' => 12,
        ];

        $bulan = $bulanMap[$q] ?? null;

        $barangMasuk = BarangMasuk::with('barang')
            ->when($q, function ($query) use ($q, $bulan) {

                $query->where(function ($sub) use ($q, $bulan) {

                    // 🔹 tanggal (angka)
                    if (is_numeric($q)) {
                        $sub->whereDay('tanggal_pembelian', $q)
                            ->orWhereMonth('tanggal_pembelian', $q)
                            ->orWhereYear('tanggal_pembelian', $q);
                    }

                    // 🔹 nama bulan (feb, februari, dll)
                    if ($bulan) {
                        $sub->orWhereMonth('tanggal_pembelian', $bulan);
                    }

                    // 🔹 field lain
                    $sub->orWhere('jumlah_barang', 'like', "%{$q}%")
                        ->orWhere('harga_satuan', 'like', "%{$q}%");
                })

                ->orWhereHas('barang', function ($barang) use ($q) {
                    $barang->where('nama_barang', 'like', "%{$q}%")
                        ->orWhere('kode_barang', 'like', "%{$q}%");
                });
            })
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
