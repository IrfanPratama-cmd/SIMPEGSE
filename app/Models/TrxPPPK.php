<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxPPPK extends Model
{
    use HasFactory;

    protected $table = "trx_guru_pppk";

    protected $guarded = ['id'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function skhpppk()
    {
        return $this->belongsTo(SekolahGuruPPPK::class, 'skh_pppk_id', 'id');
    }
}
