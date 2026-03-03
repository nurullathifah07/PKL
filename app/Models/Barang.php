<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BarangMasuk;
use App\Models\BarangKeluarDetail;


class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'stok_minimal',
        'stok',
    ];

    // STATUS OTOMATIS (TIDAK DISIMPAN DI DB)
    public function getStatusAttribute()
    {
        if ($this->stok <= 0) {
            return 'habis';
        } elseif ($this->stok <= $this->stok_minimal) {
            return 'menipis';
        }
        return 'tersedia';
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_barang');
    }

    public function barangKeluarDetail()
    {
        return $this->hasMany(BarangKeluarDetail::class, 'id_barang');
    }
}
