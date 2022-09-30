<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmAbsensi extends Model
{
    use HasFactory;

    protected $table = "tm_absensi";

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'id', 'absensi_id');
    }
}
