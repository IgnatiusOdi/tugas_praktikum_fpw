<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "mahasiswa";

    protected $fillable = [
        "mahasiswa_nrp",
        "mahasiswa_nama",
        "mahasiswa_email",
        "mahasiswa_telepon",
        "mahasiswa_tanggal_lahir",
        "jurusan_id",
        "mahasiswa_angkatan",
        "mahasiswa_password",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelas_mahasiswa()
    {
        return $this->hasMany(KelasMahasiswa::class);
    }

    public function mahasiswa_module()
    {
        return $this->hasMany(MahasiswaModule::class);
    }
}
