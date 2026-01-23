<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarDetail extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_detail';
    protected $primaryKey = 'id_detail_bk';

    protected $fillable = [
        'id_barang_keluar',
        'id_barang',
        'jumlah_keluar'
    ];

    /**
     * Relasi ke header bon
     */
    public function barangKeluar()
    {
        return $this->belongsTo(
            BarangKeluar::class,
            'id_barang_keluar',
            'id_barang_keluar'
        );
    }

    /**
     * Relasi ke master barang
     */
    public function barang()
    {
        return $this->belongsTo(
            Barang::class,
            'id_barang',
            'id_barang'
        );
    }
}
