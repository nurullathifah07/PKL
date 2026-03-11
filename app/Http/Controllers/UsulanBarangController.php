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
    public function index()
    {
        $level = Auth::user()->level;

        if ($level == 'pegawai') {

            $pegawai = Pegawai::where('id_akun', Auth::id())->first();

            $usulan = UsulanBarang::where('id_pegawai', $pegawai->id_pegawai)
                        ->latest()
                        ->get();

        } else {

            $usulan = UsulanBarang::with('pegawai')
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


    // admin setujui usulan
    public function setujui($id)
    {
        $usulan = UsulanBarang::findOrFail($id);

        $usulan->status = 'disetujui';
        $usulan->save();

        return back()->with('success','Usulan berhasil disetujui');
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
