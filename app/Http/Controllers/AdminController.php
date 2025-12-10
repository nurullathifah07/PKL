<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Beranda Admin
    public function beranda()
    {
        return view('admin.beranda');
    }

    //Akun
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

    //Pegawai
    public function pegawai()
    {
        return view('admin.pegawai');
    }
    public function pegawai_tambah()
    {
        return view('admin.pegawai_tambah');
    }

    //Barang
    public function barang()
    {
        return view('admin.barang');
    }
    public function barang_tambah()
    {
        return view('admin.barang_tambah');
    }

    //Barang Masuk
    public function barang_masuk()
    {
        return view('admin.barang_masuk');
    }
    public function barang_masuk_tambah()
    {
        return view('admin.barang_masuk_tambah');
    }

    //Barang Keluar
    public function barang_keluar()
    {
        return view('admin.barang_keluar');
    }
    public function barang_keluar_tambah()
    {
        return view('admin.barang_keluar_tambah');
    }

}


