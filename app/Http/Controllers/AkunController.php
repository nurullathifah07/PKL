<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function akun()
    {
        return view('admin.akun');
    }
    public function akun_tambah()
    {
        return view('admin.akun_tambah');
    }
    public function akun_edit()
    {
        return view('admin.akun_edit');
    }
}
