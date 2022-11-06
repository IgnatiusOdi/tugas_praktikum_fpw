<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosen extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "dosen";

    protected $fillable = [
        "dosen_username",
        "dosen_nama",
        "dosen_email",
        "dosen_telepon",
        "dosen_tanggal_lahir",
        "jurusan_id",
        "dosen_kelulusan",
        "dosen_password",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
