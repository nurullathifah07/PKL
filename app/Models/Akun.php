<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'akun';

    // Primary key
    protected $primaryKey = 'id_akun';

    // Kolom yang boleh diisi (WAJIB untuk create/update)
    protected $fillable = [
        'username',
        'email',
        'password',
        'level'
    ];
}
