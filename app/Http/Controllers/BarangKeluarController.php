<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pegawai;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangKeluarController extends Controller
{
    /*
    |==================================================
    | HELPER
    |==================================================
    */
    private function level()
    {
        return Auth::user()->level; // admin / operator
    }

    private function viewPath($view)
    {
        return $this->level() . '.barang_keluar.' . $view;
    }

    private function indexRoute()
    {
        return $this->level() === 'operator'
            ? 'operator.barang_keluar.index'
            : 'admin.barang_keluar.index';
    }

    /*
    |==================================================
    | INDEX
    |==================================================
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

        $barangKeluar = BarangKeluar::with(['pegawai', 'details.barang'])
            ->when($q, function ($query) use ($q, $bulan) {

                $query->where(function ($sub) use ($q, $bulan) {

                    // 🔹 tanggal keluar (angka)
                    if (is_numeric($q)) {
                        $sub->whereDay('tanggal_keluar', $q)
                            ->orWhereMonth('tanggal_keluar', $q)
                            ->orWhereYear('tanggal_keluar', $q);
                    }

                    // 🔹 nama bulan (feb, februari, dll)
                    if ($bulan) {
                        $sub->orWhereMonth('tanggal_keluar', $bulan);
                    }

                    // 🔹 keterangan
                    $sub->orWhere('keterangan', 'like', "%{$q}%");
                })

                // 🔹 pegawai
                ->orWhereHas('pegawai', function ($pegawai) use ($q) {
                    $pegawai->where('nama_pegawai', 'like', "%{$q}%")
                            ->orWhere('nip', 'like', "%{$q}%");
                })

                // 🔹 barang (detail)
                ->orWhereHas('details.barang', function ($barang) use ($q) {
                    $barang->where('nama_barang', 'like', "%{$q}%")
                        ->orWhere('kode_barang', 'like', "%{$q}%");
                });
            })
            ->orderBy('tanggal_keluar', 'desc')
            ->get();

        return view($this->viewPath('index'), compact('barangKeluar'));
    }

    /*
    |==================================================
    | CREATE
    |==================================================
    */
    public function create()
    {
        $barang  = Barang::orderBy('nama_barang')->get();
        $pegawai = Pegawai::orderBy('nama_pegawai')->get();

        return view(
            $this->viewPath('create'),
            compact('barang', 'pegawai')
        );
    }

    /*
    |==================================================
    | STORE
    |==================================================
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

                // cek bon pegawai di hari sama
                $barangKeluar = BarangKeluar::where('tanggal_keluar', $request->tanggal_keluar)
                    ->where('id_pegawai', $request->id_pegawai)
                    ->first();

                if (!$barangKeluar) {
                    $barangKeluar = BarangKeluar::create([
                        'tanggal_keluar' => $request->tanggal_keluar,
                        'id_pegawai'     => $request->id_pegawai,
                        'keterangan'     => $request->keterangan,
                    ]);
                }

                foreach ($request->barang as $item) {

                    $barang = Barang::lockForUpdate()
                        ->findOrFail($item['id_barang']);

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
            ->route($this->indexRoute())
            ->with('success', 'Barang keluar berhasil disimpan');
    }

    /*
    |==================================================
    | SHOW
    |==================================================
    */
    public function show($id)
    {
        $barangKeluar = BarangKeluar::with([
            'pegawai',
            'details.barang'
        ])->findOrFail($id);

        $pejabatMengetahui = Pegawai::where(
            'jabatan',
            'Kepala Subbagian Umum'
        )->first();

        return view(
            $this->viewPath('show'),
            compact('barangKeluar', 'pejabatMengetahui')
        );
    }

    /*
    |==================================================
    | EDIT
    |==================================================
    */
    public function edit($id)
    {
        $barangKeluar = BarangKeluar::with('details.barang')
            ->findOrFail($id);

        $barang = Barang::orderBy('nama_barang')->get();

        return view(
            $this->viewPath('edit'),
            compact('barangKeluar', 'barang')
        );
    }

    /*
    |==================================================
    | UPDATE
    |==================================================
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

                $barangKeluar = BarangKeluar::with('details')
                    ->findOrFail($id);

                foreach ($request->barang as $item) {

                    $detail = BarangKeluarDetail::findOrFail($item['id_detail_bk']);
                    $barang = Barang::lockForUpdate()
                        ->findOrFail($item['id_barang']);

                    // rollback stok lama
                    $barang->stok += $detail->jumlah_keluar;

                    if ($barang->stok < $item['jumlah_keluar']) {
                        throw new \Exception(
                            'Stok ' . $barang->nama_barang . ' tidak mencukupi'
                        );
                    }

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
            ->route($this->indexRoute())
            ->with('success', 'Bon barang keluar berhasil diperbarui');
    }

    /*
    |==================================================
    | DESTROY
    |==================================================
    */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $barangKeluar = BarangKeluar::with('details')
                ->findOrFail($id);

            foreach ($barangKeluar->details as $detail) {
                $barang = Barang::find($detail->id_barang);
                $barang->stok += $detail->jumlah_keluar;
                $barang->save();
            }

            $barangKeluar->delete();
        });

        return redirect()
            ->route($this->indexRoute())
            ->with('success', 'Data barang keluar berhasil dihapus');
    }
}
