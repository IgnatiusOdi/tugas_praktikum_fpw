<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = "kelas";
    public $timestamps = false;

    protected $fillable = [
        "matakuliah_id",
        "hari_id",
        "jam_id",
        "periode_id",
        "dosen_id",
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }

    public function jam()
    {
        return $this->belongsTo(Jam::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    public function kelas_mahasiswa()
    {
        return $this->hasMany(KelasMahasiswa::class);
    }

    public function module()
    {
        return $this->hasMany(Module::class);
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class);
    }
}
