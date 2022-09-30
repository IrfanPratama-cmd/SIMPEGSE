<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruPPPK extends Model
{
    use HasFactory;

    protected $table = "tbl_guru_pppk";

    protected $guarded = ['id'];

    // public function guruPPPK()
    // {
    //     return $this->belongsTo(SekolahGuruPPPK::class);
    // }
}
