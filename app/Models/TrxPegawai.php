<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxPegawai extends Model
{
    use HasFactory;

    protected $table = "trx_pegawai";

    protected $guarded = ['id'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
