<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModule extends Model
{
    use HasFactory;

    protected $table = "mahasiswa_module";

    protected $fillable = [
        "module_id",
        "mahasiswa_id",
        "module_jawaban",
        "created_at",
        "updated_at",
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
