<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'sekolah_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_email_verified'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function ortu()
    {
        return $this->belongsTo(Ortu::class, 'user_id');
    }

    public function pasangan()
    {
        return $this->belongsTo(Pasangan::class, 'user_id');
    }

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'user_id');
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'user_id');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'user_id');
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'user_id');
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
}
