<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';

    public $timestamps = false;

    protected $fillable = [
        'nis',
        'nama',
        'id_kelas',
        'password',
        'foto'
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'nis', 'username');
    }

    // relasi ke kelas
    public function kelas()
{
    return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
}
    // relasi ke konseling
    public function konseling()
    {
        return $this->hasMany(Konseling::class, 'id_siswa', 'id_siswa');
    }
}