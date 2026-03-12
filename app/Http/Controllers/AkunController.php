<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{

    /*
    =========================
    TAMPIL DATA
    =========================
    */
    public function index(Request $request)
    {
        $q = $request->q;

        $akun = Akun::when($q, function ($query) use ($q) {
                    $query->where('username', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%")
                          ->orWhere('level', 'like', "%{$q}%");
                })
                ->orderBy('id_akun', 'desc')
                ->get();

        return view('admin.akun.index', compact('akun'));
    }


    /*
    =========================
    FORM TAMBAH
    =========================
    */
    public function create()
    {
        return view('admin.akun.create');
    }


    /*
    =========================
    SIMPAN DATA
    =========================
    */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'email'    => 'required|email|unique:akun,email',
            'password' => 'required|min:6|confirmed',
            'level'    => 'required'
        ]);

        Akun::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'level'    => $request->level,
        ]);

        return redirect()->route('admin.akun.index')
            ->with('success', 'Akun berhasil ditambahkan');
    }


    /*
    =========================
    FORM EDIT
    =========================
    */
    public function edit($id)
    {
        $akun = Akun::findOrFail($id);
        return view('admin.akun.edit', compact('akun'));
    }


    /*
    =========================
    UPDATE DATA
    =========================
    */
    public function update(Request $request, $id)
    {
        $akun = Akun::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:100',
            'email'    => 'required|email',
            'password' => 'nullable|min:6|confirmed',
            'level'    => 'required'
        ]);

        $data = [
            'username' => $request->username,
            'email'    => $request->email,
            'level'    => $request->level,
        ];

        // jika password diisi baru di update
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $akun->update($data);

        return redirect()->route('admin.akun.index')
            ->with('success', 'Akun berhasil diperbarui');
    }


    /*
    =========================
    HAPUS DATA
    =========================
    */
    public function destroy($id)
    {
        $akun = Akun::findOrFail($id);
        $akun->delete();

        return redirect()->route('admin.akun.index')
            ->with('success', 'Akun berhasil dihapus');
    }


    /*
    =========================
    UBAH PASSWORD (USER LOGIN)
    =========================
    */
    public function ubahPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $akun = Akun::find(Auth::id());

        $akun->password = Hash::make($request->password);
        $akun->save();

        Auth::logout();

        return redirect('/login')->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }
}
