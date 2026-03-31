<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'nis', 'username');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'nip', 'username');
    }
}