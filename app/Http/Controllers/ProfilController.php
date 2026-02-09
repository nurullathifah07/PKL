<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $akun = Auth::user();
        $pegawai = $akun->pegawai;

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
        $pegawai->update(
            collect($validated)->except('foto')->toArray()
        );

        // handle foto
        if ($request->hasFile('foto')) {

            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            $path = $request->file('foto')->store('foto_pegawai', 'public');
            $pegawai->update(['foto' => $path]);
        }

        // ✅ REDIRECT SESUAI ROLE
        $dashboardRoute = $akun->level === 'operator'
            ? 'operator.dashboard'
            : 'pegawai.dashboard';

        return redirect()
            ->route($dashboardRoute)
            ->with('success', 'Profil berhasil diperbarui');
    }
}
