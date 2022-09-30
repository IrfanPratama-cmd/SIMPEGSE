<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxGuruHonorer extends Model
{
    use HasFactory;

    protected $table = "trx_guru_honorer";

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
