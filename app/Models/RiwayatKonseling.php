<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKonseling extends Model
{
    protected $table = 'riwayat_konseling';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;

    protected $fillable = [
        'id_konseling',
        'tanggal',
        'catatan',
        'id_guru'
    ];

    public function konseling()
    {
        return $this->belongsTo(Konseling::class, 'id_konseling', 'id_konseling');
    }
}
