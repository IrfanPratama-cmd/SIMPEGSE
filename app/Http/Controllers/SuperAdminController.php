<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function dataSekolah()
    {
        $sekolah = Sekolah::paginate(6);

        return view('sekolah.index', [
            'sekolah' => $sekolah
        ]);
    }
}
