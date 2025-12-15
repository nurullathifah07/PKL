<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    //Pegawai
    public function pegawai()
    {
        return view('admin.pegawai');
    }
    public function pegawai_tambah()
    {
        return view('admin.pegawai_tambah');
    }
    public function pegawai_edit()
    {
        return view('admin.pegawai_edit');
    }
}
