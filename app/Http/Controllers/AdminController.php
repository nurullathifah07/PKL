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

    //Profil
     public function profil()
    {
        return view('admin.profil');
    }
    public function profil_edit()
    {
        return view('admin.profil_edit');
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
    public function barang_masuk_edit()
    {
        return view('admin.barang_masuk_edit');
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
    public function barang_keluar_edit()
    {
        return view('admin.barang_keluar_edit');
    }

    //Notifikasi
    public function notifikasi()
    {
        return view('admin.notifikasi');
    }

}
