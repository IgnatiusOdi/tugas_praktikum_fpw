<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = "jurusan";
    public $timestamps = false;

    protected $fillable = [
        "jurusan_kode",
        "jurusan_nama",
    ];

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function matakuliah()
    {
        return $this->hasMany(Matakuliah::class);
    }
}
