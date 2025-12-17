<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Akun;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    // 1. TAMPIL DATA
    public function index()
    {
        $pegawai = Pegawai::with('akun')->get();
        return view('admin.pegawai.index', compact('pegawai'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        $akun = Akun::all(); // untuk dropdown username
        return view('admin.pegawai.create', compact('akun'));
    }

    // 3. SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'id_akun' => 'required',
            'nip_bps' => 'required|unique:pegawai',
            'nip' => 'required|unique:pegawai',
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
            'golongan_akhir' => 'required',
            'pendidikan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
        ]);

        Pegawai::create($request->all());

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan');
    }

    // 4. DETAIL DATA
    public function show($id)
    {
        $pegawai = Pegawai::with('akun')->findOrFail($id);
        return view('admin.pegawai.show', compact('pegawai'));
    }

    // 5. FORM EDIT
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $akun = Akun::all();

        return view('admin.pegawai.edit', compact('pegawai', 'akun'));
    }

    // 6. UPDATE DATA
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'id_akun' => 'required',
            'nip_bps' => 'required|unique:pegawai,nip_bps,' . $pegawai->id_pegawai . ',id_pegawai',
            'nip' => 'required|unique:pegawai,nip,' . $pegawai->id_pegawai . ',id_pegawai',
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
            'golongan_akhir' => 'required',
            'pendidikan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
        ]);

        $pegawai->update($request->all());

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui');
    }

    // 7. HAPUS DATA
    public function destroy($id)
    {
        Pegawai::findOrFail($id)->delete();

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus');
    }
}
