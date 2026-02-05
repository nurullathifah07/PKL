<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Tampilkan profil pegawai login
     */
    public function index()
    {
        $akun = Auth::user();
        $pegawai = $akun->pegawai;

        return view('profil.index', compact('akun', 'pegawai'));
    }

    /**
     * Halaman edit profil
     */
    public function edit()
    {
        $akun = Auth::user();
        $pegawai = $akun->pegawai;

        return view('profil.edit', compact('akun', 'pegawai'));
    }

    /**
     * Update profil pegawai login
     */
    public function update(Request $request)
    {
        $pegawai = Auth::user()->pegawai;

        $validated = $request->validate([
            'nama_pegawai'  => 'required|string|max:255',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required|string|max:50',
            'pendidikan'    => 'nullable|string|max:50',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // update data selain foto
        $pegawai->update(collect($validated)->except('foto')->toArray());

        // handle foto
        if ($request->hasFile('foto')) {

            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            $path = $request->file('foto')->store('foto_pegawai', 'public');
            $pegawai->update(['foto' => $path]);
        }

        // 🔴 INI YANG DIPERBAIKI
        return redirect()
            ->route('pegawai.dashboard')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
