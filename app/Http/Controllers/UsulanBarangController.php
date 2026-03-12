<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\UsulanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsulanBarangController extends Controller
{

    // menentukan view berdasarkan level user
    private function viewPath($view)
    {
        $level = Auth::user()->level;
        return $level . '.usulan_barang.' . $view;
    }


    // menampilkan daftar usulan
    public function index(Request $request)
    {
        $level = Auth::user()->level;
        $q = strtolower($request->q);

        // mapping bulan indonesia
        $bulanMap = [
            'januari'=>1,'jan'=>1,
            'februari'=>2,'feb'=>2,
            'maret'=>3,'mar'=>3,
            'april'=>4,'apr'=>4,
            'mei'=>5,
            'juni'=>6,'jun'=>6,
            'juli'=>7,'jul'=>7,
            'agustus'=>8,'agu'=>8,
            'september'=>9,'sep'=>9,
            'oktober'=>10,'okt'=>10,
            'november'=>11,'nov'=>11,
            'desember'=>12,'des'=>12,
        ];

        $bulan = $bulanMap[$q] ?? null;

        if ($level == 'pegawai') {

            $pegawai = Pegawai::where('id_akun', Auth::id())->first();

            $usulan = UsulanBarang::where('id_pegawai', $pegawai->id_pegawai)

                ->when($q, function ($query) use ($q,$bulan) {

                    $query->where(function ($sub) use ($q,$bulan) {

                        $sub->where('nama_barang_usulan','like',"%{$q}%")
                            ->orWhere('status','like',"%{$q}%")

                            // format tanggal 11-03-2026
                            ->orWhereRaw("DATE_FORMAT(created_at,'%d-%m-%Y') like ?",["%{$q}%"])

                            // format bulan tahun
                            ->orWhereRaw("DATE_FORMAT(created_at,'%m-%Y') like ?",["%{$q}%"])

                            // tahun
                            ->orWhereYear('created_at',$q)

                            // hari
                            ->orWhereDay('created_at',$q);

                        if($bulan){
                            $sub->orWhereMonth('created_at',$bulan);
                        }

                    });

                })

                ->latest()
                ->get();

        } else {

            $usulan = UsulanBarang::with('pegawai')

                ->when($q, function ($query) use ($q,$bulan) {

                    $query->where(function ($sub) use ($q,$bulan) {

                        $sub->where('nama_barang_usulan','like',"%{$q}%")
                            ->orWhere('status','like',"%{$q}%")

                            ->orWhereRaw("DATE_FORMAT(created_at,'%d-%m-%Y') like ?",["%{$q}%"])
                            ->orWhereRaw("DATE_FORMAT(created_at,'%m-%Y') like ?",["%{$q}%"])

                            ->orWhereYear('created_at',$q)
                            ->orWhereDay('created_at',$q);

                        if($bulan){
                            $sub->orWhereMonth('created_at',$bulan);
                        }

                    });

                })

                ->latest()
                ->get();
        }

        return view($this->viewPath('index'), compact('usulan'));
    }


    // form tambah usulan (pegawai)
    public function create()
    {
        return view('pegawai.usulan_barang.create');
    }


    // simpan usulan
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang_usulan' => 'required',
            'jumlah_usulan' => 'required|integer'
        ]);

        $pegawai = Pegawai::where('id_akun', Auth::id())->first();

        UsulanBarang::create([
            'nama_barang_usulan' => $request->nama_barang_usulan,
            'jumlah_usulan' => $request->jumlah_usulan,
            'keterangan' => $request->keterangan,
            'id_pegawai' => $pegawai->id_pegawai,
            'status' => 'pending'
        ]);

        return redirect()->route(Auth::user()->level.'.usulan_barang.index')
            ->with('success','Usulan barang berhasil dikirim');
    }


    // admin setujui usulan → redirect ke tambah barang
    public function setujui($id)
    {
        $usulan = UsulanBarang::findOrFail($id);

        // ubah status
        $usulan->status = 'disetujui';
        $usulan->save();

        // redirect ke tambah barang dengan nama barang otomatis
        return redirect()->route('admin.barang.create', [
            'nama_barang' => $usulan->nama_barang_usulan,
            'id_usulan' => $usulan->id_usulan_barang
        ]);
    }


    // admin tolak usulan
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required'
        ]);

        $usulan = UsulanBarang::findOrFail($id);

        $usulan->status = 'ditolak';
        $usulan->alasan_penolakan = $request->alasan_penolakan;
        $usulan->save();

        return back()->with('success','Usulan berhasil ditolak');
    }


    // hapus usulan
    public function destroy($id)
    {
        $usulan = UsulanBarang::findOrFail($id);
        $usulan->delete();

        return back()->with('success','Usulan berhasil dihapus');
    }

}
