<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('akun')->get();
        return view('admin.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        $akun = Akun::all();
        return view('admin.pegawai.create', compact('akun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_akun'         => 'required',
            'status_pegawai'  => 'required|in:PNS,Non PNS',
            'nip_bps'         => 'nullable|unique:pegawai,nip_bps',
            'nip'             => 'nullable|unique:pegawai,nip',
            'nama_pegawai'    => 'required',
            'jabatan'         => 'required',
            'subbagian'       => 'nullable|string|max:100',
            'golongan_akhir'  => 'required',
            'pendidikan'      => 'required',
            'tempat_lahir'    => 'required',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required|in:L,P',
            'agama'           => 'required',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'id_akun',
            'status_pegawai',
            'nip_bps',
            'nip',
            'nama_pegawai',
            'jabatan',
            'subbagian',
            'golongan_akhir',
            'pendidikan',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        Pegawai::create($data);

        return redirect()
            ->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function show($id)
    {
        $pegawai = Pegawai::with('akun')->findOrFail($id);
        return view('admin.pegawai.show', compact('pegawai'));
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $akun = Akun::all();

        return view('admin.pegawai.edit', compact('pegawai', 'akun'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'id_akun'        => 'required',
            'status_pegawai' => 'required|in:PNS,Non PNS',
            'nip_bps'        => 'nullable|unique:pegawai,nip_bps,' . $pegawai->id_pegawai . ',id_pegawai',
            'nip'            => 'nullable|unique:pegawai,nip,' . $pegawai->id_pegawai . ',id_pegawai',
            'nama_pegawai'   => 'required',
            'jabatan'        => 'required',
            'subbagian'      => 'nullable|string|max:100',
            'golongan_akhir' => 'required',
            'pendidikan'     => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'agama'          => 'required',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'id_akun',
            'status_pegawai',
            'nip_bps',
            'nip',
            'nama_pegawai',
            'jabatan',
            'subbagian',
            'golongan_akhir',
            'pendidikan',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
        ]);

        if ($request->hasFile('foto')) {

            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            $data['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        $pegawai->update($data);

        return redirect()
            ->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        $pegawai->delete();

        return redirect()
            ->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus');
    }
}
