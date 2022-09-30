<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        return view('kelas.index', [
            'kelas' => Kelas::where('sekolah_id', $sekolah_id)->orderBy('nama_kelas', 'asc')->paginate(6),
            'nama_sekolah' => $nama_sekolah
        ]);
    }

    public function tambahKelas(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];

        $validatedData = $request->validate([
            'nama_kelas' => 'required|max:255',
        ]);

        $validatedData['sekolah_id'] = $sekolah_id;

        Kelas::create($validatedData);

        return redirect('/dataKelas')->with('success', 'Kelas Berhasil di Tambah');
    }
}
