<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{

    public function index()
    {

        $akun = Auth::user();              // user login
        $pegawai = $akun->pegawai;         // relasi ke pegawai

        return view('profil.index', compact('akun', 'pegawai'));
    }


    public function edit()
    {
        $akun = Auth::user();
        $pegawai = $akun->pegawai;

        return view('profil.edit', compact('akun', 'pegawai'));
    }


    public function update(Request $request)
    {
        $akun = Auth::user();
        $pegawai = $akun->pegawai;

        $request->validate([
            'nama_pegawai'   => 'required|string|max:255',
            'tempat_lahir'   => 'required|string',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'agama'          => 'required|string',
            'pendidikan'     => 'nullable|string',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pegawai->update($request->except('foto'));

        if ($request->hasFile('foto')) {

            if ($pegawai->foto) {
                Storage::delete('public/' . $pegawai->foto);
            }

            $path = $request->file('foto')->store('foto_pegawai', 'public');
            $pegawai->update(['foto' => $path]);
        }

        return redirect()
            ->route('profil.index')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
