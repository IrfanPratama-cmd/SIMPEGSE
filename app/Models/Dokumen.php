<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = "tbl_dokumen";

    protected $guarded = ['id'];

    public function TMdokumen()
    {
        return $this->belongsTo(TMDokumen::class, 'dokumen_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }
}
