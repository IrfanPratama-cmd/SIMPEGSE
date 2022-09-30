<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruASN extends Model
{
    use HasFactory;

    protected $table = "tbl_guru_asn";

    protected $guarded = ['id'];

    public function guruASN()
    {
        return $this->hasMany(SekolahGuruASN::class);
    }
}
