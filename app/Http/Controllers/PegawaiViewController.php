<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\UsulanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiViewController extends Controller
{
    public function dashboard(Request $request)
    {
        $akun = Auth::user();
        $pegawai = $akun->pegawai;

        // total jenis barang
        $totalBarang = Barang::count('id_barang');

        // usulan diterima
        $usulanDiterima = UsulanBarang::where('id_pegawai', $pegawai->id)
                            ->where('status', 'diterima')
                            ->count();

        // usulan ditolak
        $usulanDitolak = UsulanBarang::where('id_pegawai', $pegawai->id)
                            ->where('status', 'ditolak')
                            ->count();

        // QUERY BARANG
        $query = Barang::query();

        // SEARCH BARANG
        if ($request->q) {
            $query->where('nama_barang', 'like', '%' . $request->q . '%');
        }

        $barang = $query->orderBy('nama_barang')->get();

        return view('pegawai.dashboard', compact(
            'akun',
            'pegawai',
            'totalBarang',
            'usulanDiterima',
            'usulanDitolak',
            'barang'
        ));
    }
}
