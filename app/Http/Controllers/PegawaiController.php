<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $akun = Akun::all();
        return view('admin.pegawai.create', compact('akun'));
    }

    // 3. SIMPAN DATA + FOTO
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
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        Pegawai::create($data);

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

    // 6. UPDATE DATA + FOTO
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
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // jika upload foto baru
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            // simpan foto baru
            $data['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        $pegawai->update($data);

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui');
    }

    // 7. HAPUS DATA + FOTO
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        $pegawai->delete();

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus');
    }
}
