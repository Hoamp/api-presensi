<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'siswa_id',
        'masuk',
        'pulang',
        'keterangan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
