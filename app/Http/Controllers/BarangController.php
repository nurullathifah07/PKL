<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    //Barang
    public function barang()
    {
        return view('admin.barang');
    }
    public function barang_tambah()
    {
        return view('admin.barang_tambah');
    }
    public function barang_edit()
    {
        return view('admin.barang_edit');
    }
}
