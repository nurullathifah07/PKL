<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelCheck
{
    public function handle(Request $request, Closure $next, ...$levels)
    {
        // belum login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // ambil level dari tabel akun
        $userLevel = Auth::user()->level;

        // kalau level tidak sesuai
        if (!in_array($userLevel, $levels)) {
            abort(403, 'Tidak punya akses');
        }

        return $next($request);
    }
}
