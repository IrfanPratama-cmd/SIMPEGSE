<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = "tbl_sekolah";
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(TMJabatan::class);
    }

    public function absen()
    {
        return $this->hasMany(Absen::class, 'id');
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class, 'id');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }

    public function izin()
    {
        return $this->hasMany(Izin::class);
    }

    public function mapel()
    {
        return $this->hasMany(TMMapel::class);
    }
}
