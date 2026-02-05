<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ===============================
    // 1. Tampilkan halaman login
    // ===============================
    public function showLogin()
    {
        return view('auth.login');
    }

    // ===============================
    // 2. Proses login
    // ===============================
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentukan field: email atau username
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        // Data login
        $credentials = [
            $loginField => $request->login,
            'password'  => $request->password,
        ];

        // Proses autentikasi
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redirect berdasarkan level
            switch (Auth::user()->level) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'pegawai':
                    return redirect()->route('pegawai.dashboard');
                case 'operator':
                    return redirect()->route('operator.dashboard');
                default:
                    Auth::logout();
                    return redirect('/login')->withErrors([
                        'login' => 'Level akun tidak dikenali'
                    ]);
            }
        }

        // Jika login gagal
        return back()
            ->withInput($request->only('login'))
            ->withErrors([
                'login' => 'Username / Email atau Password salah'
            ]);
    }

    // ===============================
    // 3. Logout
    // ===============================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
