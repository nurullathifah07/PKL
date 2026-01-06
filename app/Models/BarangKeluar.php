<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_barang_keluar';

    protected $fillable = [
        'tanggal_keluar',
        'nama_pemohon',
        'keterangan',
        'mengetahui'
    ];

    // 1 surat → banyak barang
    public function details()
    {
        return $this->hasMany(
            BarangKeluarDetail::class,
            'id_barang_keluar',
            'id_barang_keluar'
        );
    }
}
