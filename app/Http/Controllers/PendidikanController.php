<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PendidikanController extends Controller
{
    public function index()
    {
        return view('pendidikan.index', [
            'pendidikan' => Pendidikan::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function tambahPendidikan()
    {
        return view('pendidikan.tambah');
    }

    public function simpanPendidikan(Request $request)
    {
        $validatedData = $request->validate([
            'jenjang_pendidikan' => 'required|max:255',
            'nama_instansi' => 'required',
            'tahun_masuk' => 'required|max:255',
            'tahun_lulus' => 'required|max:255',
        ]);

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$pegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];

        $validatedData['pegawai_id'] = $pegawai_id;

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['prodi'] = $request->prodi;

        Pendidikan::create($validatedData);

        return redirect('/pendidikan')->with('success', 'Data Pendidikan Berhasil di Tambah');
    }

    public function detailPendidikan($id, Pendidikan $pendidikan)
    {
        $id = Crypt::decrypt($id);
        $pendidikan = Pendidikan::findOrFail($id);

        return view('pendidikan.detail', [
            'pendidikan' => $pendidikan
        ]);
    }

    public function editPendidikan($id, Pendidikan $pendidikan)
    {
        $id = Crypt::decrypt($id);
        $pendidikan = Pendidikan::findOrFail($id);

        return view('pendidikan.edit', [
            'pendidikan' => $pendidikan
        ]);
    }

    public function updatePendidikan($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'jenjang_pendidikan' => 'required|max:255',
            'nama_instansi' => 'required',
            'tahun_masuk' => 'required|max:255',
            'tahun_lulus' => 'required|max:255',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['prodi'] = $request->prodi;

        Pendidikan::where('id', $id)
            ->update($validatedData);

        return redirect('/pendidikan')->with('success', 'Data Pendidikan Berhasil di Update');
    }
}
