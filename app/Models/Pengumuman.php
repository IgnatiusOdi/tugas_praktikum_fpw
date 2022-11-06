<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = "pengumuman";

    protected $fillable = [
        "kelas_id",
        "pengumuman_deskripsi",
        "pengumuman_link",
        "created_at",
        "updated_at",
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
