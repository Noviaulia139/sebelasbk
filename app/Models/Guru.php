<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Guru extends Authenticatable
{
    protected $table = 'guru_bk';
    protected $primaryKey = 'id_guru';
    public $timestamps = false;

    protected $fillable = [
        'nip',
        'nama',
        'password',
        'foto',
    ];

    protected $hidden = [
        'password',
    ];
}
