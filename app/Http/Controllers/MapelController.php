<?php

namespace App\Http\Controllers;

use App\Models\GuruMapel;
use App\Models\Pegawai;
use App\Models\Sekolah;
use App\Models\TMMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MapelController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        return view('mapel.index', [
            'mapel' => TMMapel::where('sekolah_id', $sekolah_id)->orderBy('nama_mapel', 'asc')->paginate(6),
            'nama_sekolah' => $nama_sekolah
        ]);
    }

    public function tambahMapel(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];

        $validatedData = $request->validate([
            'nama_mapel' => 'required|max:255',
            'gaji' => 'required',
        ]);

        $validatedData['sekolah_id'] = $sekolah_id;

        TMMapel::create($validatedData);

        return redirect('/mapel')->with('success', 'Mapel Berhasil di Tambah');
    }

    public function hapusMapel($id)
    {
        $id = Crypt::decrypt($id);
        TMMapel::destroy($id);

        return redirect('/mapel')->with('success', 'Mapel Berhasil di Hapus');
    }

    public function editMapel($id, TMMapel $mapel)
    {
        $id = Crypt::decrypt($id);
        $mapel = TMMapel::findOrFail($id);

        return view('mapel.edit', [
            'mapel' => $mapel
        ]);
    }

    public function updateMapel($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nama_mapel' => 'required|max:255',
            'gaji' => 'required',
        ];

        $validatedData = $request->validate($rules);

        TMMapel::where('id', $id)
            ->update($validatedData);

        return redirect('/mapel')->with('success', 'Mapel Berhasil di Update');
    }

    public function detailMapel($id)
    {
        $id = Crypt::decrypt($id);

        $mapel = TMMapel::findOrFail($id);

        return view('mapel.detail', [
            'mapel' => $mapel
        ]);
    }

    public function mapelGuru()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        $pegawai = Pegawai::where('sekolah_id', $sekolah_id)->get();
        $TMMapel = TMMapel::where('sekolah_id', $sekolah_id)->get();

        return view('mapel.guru', [
            'mapel' => GuruMapel::where('sekolah_id', $sekolah_id)->orderBy('pegawai_id', 'asc')->paginate(6),
            'nama_sekolah' => $nama_sekolah,
            'pegawai' => $pegawai,
            'TMMapel' => $TMMapel
        ]);
    }

    public function tambahMapelGuru(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];

        $validatedData = $request->validate([
            'pegawai_id' => 'required|max:255',
            'mapel_id' => 'required',
        ]);

        $validatedData['sekolah_id'] = $sekolah_id;

        GuruMapel::create($validatedData);

        return redirect('/mapelGuru')->with('success', 'Mapel Berhasil di Tambah');
    }

    public function hapusMapelGuru($id)
    {
        $id = Crypt::decrypt($id);
        GuruMapel::destroy($id);

        return redirect('/mapelGuru')->with('success', 'Mapel Berhasil di Hapus');
    }

    public function editMapelGuru($id, TMMapel $mapel)
    {
        $id = Crypt::decrypt($id);
        $mapel = GuruMapel::findOrFail($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        $pegawai = Pegawai::where('sekolah_id', $sekolah_id)->get();
        $TMMapel = TMMapel::where('sekolah_id', $sekolah_id)->get();

        return view('mapel.editGuru', [
            'mapel' => $mapel,
            'pegawai' => $pegawai,
            'TMMapel' => $TMMapel
        ]);
    }

    public function updateMapelGuru($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'pegawai_id' => 'required',
            'mapel_id' => 'required',
        ];

        $validatedData = $request->validate($rules);

        GuruMapel::where('id', $id)
            ->update($validatedData);

        return redirect('/mapelGuru')->with('success', 'Jabatan Berhasil di Update');
    }
}
