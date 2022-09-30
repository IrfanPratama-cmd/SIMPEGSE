<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = "tbl_location";

    protected $guarded = ['id'];

    public function presensi()
    {
        return $this->belongsTo(Presensi::class);
    }
}
