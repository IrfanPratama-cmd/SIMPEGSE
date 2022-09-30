<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMDokumen extends Model
{
    use HasFactory;

    protected $table = "tm_dokumen";

    protected $guarded = ['id'];

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'id', 'dokumen_id');
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }
}
