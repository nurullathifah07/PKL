<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_barang_keluar';

    protected $fillable = [
        'id_pegawai',
        'tanggal_keluar',
        'keterangan'
    ];

    /**
     * Relasi ke pegawai (pemohon)
     */
    public function pegawai()
    {
        return $this->belongsTo(
            Pegawai::class,
            'id_pegawai',
            'id_pegawai'
        );
    }

    /**
     * Relasi ke detail barang keluar
     * (1 bon punya banyak barang)
     */
    public function details()
    {
        return $this->hasMany(
            BarangKeluarDetail::class,
            'id_barang_keluar',
            'id_barang_keluar'
        );
    }
}
