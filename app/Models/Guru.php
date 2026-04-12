<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru_bk';
    protected $primaryKey = 'id_guru';

    public $timestamps = true;

    protected $fillable = [
        'nip',
        'nama',
     
        'foto'
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'nip', 'username');
    }

    // relasi ke kelas
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_guru', 'id_guru');
    }

    // relasi ke konseling
    public function konseling()
    {
        return $this->hasMany(Konseling::class, 'id_guru', 'id_guru');
    }
}