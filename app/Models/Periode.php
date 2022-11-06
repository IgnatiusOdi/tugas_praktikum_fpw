<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $table = "periode";
    public $timestamps = false;

    protected $fillable = [
        "periode_tahun",
        "periode_status"
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
