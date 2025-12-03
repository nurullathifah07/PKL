<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function beranda()
    {
        return view('admin.beranda');
    }

    public function akun()
    {
        return view('admin.akun');
    }


    public function barang()
    {
        return view('admin.barang');
    }

    public function pegawai()
    {
        return view('admin.pegawai');
    }
}


