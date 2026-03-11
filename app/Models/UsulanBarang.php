<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsulanBarang extends Model
{
    protected $table = 'usulan_barang';

    protected $primaryKey = 'id_usulan_barang';

    protected $fillable = [
        'nama_barang_usulan',
        'jumlah_usulan',
        'keterangan',
        'id_pegawai',
        'status',
        'alasan_penolakan'
    ];

    // relasi ke tabel pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
