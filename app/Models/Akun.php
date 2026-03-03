<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 

class Akun extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'akun';
    protected $primaryKey = 'id_akun';

    protected $fillable = [
        'username',
        'email',
        'password',
        'level'
    ];

    protected $hidden = [
        'password'
    ];

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id_akun', 'id_akun');
    }
}
