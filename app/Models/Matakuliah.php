<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = "matakuliah";
    public $timestamps = false;

    protected $fillable = [
        "matakuliah_kode",
        "matakuliah_nama",
        "jurusan_id",
        "matakuliah_semester",
        "matakuliah_sks",
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
