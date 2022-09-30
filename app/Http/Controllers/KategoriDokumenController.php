<?php

namespace App\Http\Controllers;

use App\Models\KategoriDokumen;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class KategoriDokumenController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        return view('kategoriDok.index', [
            'dokumen' => KategoriDokumen::where('sekolah_id', $sekolah_id)->orderBy('kategori', 'asc')->paginate(6),
            'nama_sekolah' => $nama_sekolah
        ]);
    }
}
