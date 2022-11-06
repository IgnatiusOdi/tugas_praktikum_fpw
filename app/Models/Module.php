<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = "module";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        "kelas_id",
        "module_nama",
        "module_keterangan",
        "module_jenis",
        "module_deadline",
        "module_status"
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mahasiswa_module()
    {
        return $this->hasMany(MahasiswaModule::class);
    }
}
