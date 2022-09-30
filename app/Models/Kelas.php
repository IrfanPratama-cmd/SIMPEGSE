<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = "tm_kelas";

    protected $guarded = ['id'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
