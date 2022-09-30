<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruHonorer extends Model
{
    use HasFactory;

    protected $table = "tbl_guru_honorer";

    protected $guarded = ['id'];
}
