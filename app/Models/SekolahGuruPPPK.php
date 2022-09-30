<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekolahGuruPPPK extends Model
{
    use HasFactory;

    protected $table = "skh_guru_pppk";

    protected $guarded = ['id'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function pppk()
    {
        return $this->belongsTo(GuruPPPK::class);
    }
}
