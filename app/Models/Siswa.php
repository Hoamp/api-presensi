<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Absensi;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'alamat',
        'jenis_kelamin',
        'password'
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
