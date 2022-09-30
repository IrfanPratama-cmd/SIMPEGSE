<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMJabatan extends Model
{
    use HasFactory;

    protected $table = "tm_jabatan";

    protected $guarded = ['id'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function jabatan()
    {
        return $this->hasMany(Jabatan::class);
    }

    public function gaji()
    {
        return $this->hasMany(GajiPegawai::class);
    }
}
