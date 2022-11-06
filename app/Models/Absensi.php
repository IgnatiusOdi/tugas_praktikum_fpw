<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = "absensi";

    protected $fillable = [
        "materi_id",
        "mahasiswa_id",
        "absensi_status",
        "created_at",
        "updated_at",
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
