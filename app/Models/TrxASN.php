<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxASN extends Model
{
    use HasFactory;

    protected $table = "trx_guru_asn";

    protected $guarded = ['id'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function skhasn()
    {
        return $this->belongsTo(SekolahGuruASN::class, 'skh_asn_id', 'id');
    }
}
