<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMMapel extends Model
{
    use HasFactory;

    protected $table = "tm_mapel";

    protected $guarded = ['id'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function mapel()
    {
        return $this->belongsTo(GuruMapel::class);
    }
}
