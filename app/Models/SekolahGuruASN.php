<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekolahGuruASN extends Model
{
    use HasFactory;

    protected $table = "skh_guru_asn";

    protected $guarded = ['id'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function asn()
    {
        return $this->belongsTo(GuruASN::class);
    }

    // public function skhasn()
    // {
    //     return $this->belongsTo(TrxASN::class);
    // }
}
