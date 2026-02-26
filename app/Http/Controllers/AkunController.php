<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    // TAMPIL DATA
    public function index()
    {
        $akun = Akun::all();
        return view('admin.akun.index', compact('akun'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin.akun.create');
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        Akun::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'level'    => $request->level,
        ]);

        return redirect()->route('admin.akun.index')
                         ->with('success', 'Akun berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $akun = Akun::findOrFail($id);
        return view('admin.akun.edit', compact('akun'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $akun = Akun::findOrFail($id);

        $akun->update([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'level'    => $request->level,
        ]);

        return redirect()->route('admin.akun.index')
                         ->with('success', 'Akun berhasil diperbarui');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        Akun::findOrFail($id)->delete();

        return redirect()->route('admin.akun.index')
                         ->with('success', 'Akun berhasil dihapus');
    }
}
