<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // relasi ke siswa
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'nis', 'username');
    }

    // relasi ke guru
    public function guru()
    {
        return $this->hasOne(Guru::class, 'nip', 'username');
    }
}