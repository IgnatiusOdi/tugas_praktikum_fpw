<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = "materi";

    protected $fillable = [
        "materi_minggu",
        "materi_judul",
        "materi_deskripsi",
        "kelas_id",
        "created_at",
        "updated_at",
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
