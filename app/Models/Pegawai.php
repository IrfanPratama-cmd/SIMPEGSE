<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = "tbl_pegawai";

    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ortu()
    {
        return $this->hasMany(Ortu::class, 'id');
    }

    public function pasangan()
    {
        return $this->hasMany(Pasangan::class, 'id');
    }

    public function anak()
    {
        return $this->hasMany(Anak::class, 'id');
    }

    public function pendidikan()
    {
        return $this->hasMany(Pendidikan::class, 'id');
    }


    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function absen()
    {
        return $this->hasMany(Absen::class, 'id');
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class);
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }

    public function izin()
    {
        return $this->hasMany(Izin::class);
    }

    public function organisasi()
    {
        return $this->hasMany(Organisasi::class);
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class);
    }

    public function seminar()
    {
        return $this->hasMany(Seminar::class);
    }

    public function mapel()
    {
        return $this->hasMany(GuruMapel::class);
    }
}
