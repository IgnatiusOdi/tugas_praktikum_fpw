<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hari extends Model
{
    use HasFactory;

    protected $table = "hari";
    public $timestamps = false;

    protected $fillable = [
        "hari_nama",
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
