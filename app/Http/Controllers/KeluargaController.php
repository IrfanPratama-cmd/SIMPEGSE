<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Ortu;
use App\Models\Pasangan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KeluargaController extends Controller
{
    public function index()
    {
        return view('keluarga.index', ["active" => "index"]);
    }

    public function ortu()
    {
        return view('keluarga.ortu', [
            "active" => "ortu",
            "ortu" => Ortu::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function pasangan()
    {
        return view('keluarga.pasangan', [
            "active" => "pasangan",
            "pasangan" => Pasangan::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function anak()
    {
        return view('keluarga.anak', [
            "active" => "anak",
            "anak" => Anak::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function tambahOrtu()
    {
        return view('keluarga.ortu.tambah');
    }

    public function simpanOrtu(Request $request)
    {
        $validatedData = $request->validate([
            'nama_ortu' => 'required|max:255',
            'nik' => 'required',
            'agama' => 'required|max:255',
            'tgl_lahir' => 'required|max:255',
            'jk' => 'required',
            'status' => 'required|max:255',
        ]);

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$pegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];


        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['pegawai_id'] = $pegawai_id;

        Ortu::create($validatedData);

        return redirect('/ortu')->with('success', 'Data Orang Tua Berhasil di Tambah');
    }

    public function detailOrtu($id, Ortu $ortu)
    {
        $id = Crypt::decrypt($id);
        $ortu = Ortu::findOrFail($id);

        return view('keluarga.ortu.detail', [
            'ortu' => $ortu
        ]);
    }

    public function editOrtu($id, Ortu $ortu)
    {
        $id = Crypt::decrypt($id);
        $ortu = Ortu::findOrFail($id);

        return view('keluarga.ortu.edit', [
            'ortu' => $ortu
        ]);
    }

    public function updateOrtu($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nama_ortu' => 'required|max:255',
            'nik' => 'required',
            'agama' => 'required|max:255',
            'tgl_lahir' => 'required|max:255',
            'jk' => 'required',
            'status' => 'required|max:255',
        ];

        $validatedData = $request->validate($rules);

        Ortu::where('id', $id)
            ->update($validatedData);

        return redirect('/ortu')->with('success', 'Data Orang Tua Berhasil di Update');
    }

    public function hapusOrtu($id)
    {
        $id = Crypt::decrypt($id);
        Ortu::destroy($id);

        return redirect('/ortu')->with('success', 'Data Orang Tua Berhasil di Hapus');
    }

    public function tambahPasangan()
    {
        return view('keluarga.pasangan.tambah');
    }

    public function simpanPasangan(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pasangan' => 'required|max:255',
            'nik' => 'required',
            'status_pasangan' => 'required',
            'no_telp' => 'required',
            'agama' => 'required|max:255',
            'tgl_lahir' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$pegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];

        $validatedData['pegawai_id'] = $pegawai_id;

        $validatedData['user_id'] = auth()->user()->id;

        Pasangan::create($validatedData);

        return redirect('/pasangan')->with('success', 'Data Pasangan Berhasil di Tambah');
    }

    public function detailPasangan($id, Pasangan $pasangan)
    {
        $id = Crypt::decrypt($id);
        $pasangan = Pasangan::findOrFail($id);

        return view('keluarga.pasangan.detail', [
            'pasangan' => $pasangan
        ]);
    }

    public function editPasangan($id, Pasangan $pasangan)
    {
        $id = Crypt::decrypt($id);
        $pasangan = Pasangan::findOrFail($id);

        return view('keluarga.pasangan.edit', [
            'pasangan' => $pasangan
        ]);
    }

    public function updatePasangan($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nama_pasangan' => 'required|max:255',
            'nik' => 'required',
            'status_pasangan' => 'required',
            'no_telp' => 'required',
            'agama' => 'required|max:255',
            'tgl_lahir' => 'required|max:255',
            'status' => 'required|max:255',
        ];

        $validatedData = $request->validate($rules);

        Pasangan::where('id', $id)
            ->update($validatedData);

        return redirect('/pasangan')->with('success', 'Data Pasangan Berhasil di Update');
    }

    public function hapusPasangan($id)
    {
        $id = Crypt::decrypt($id);
        Pasangan::destroy($id);

        return redirect('/pasangan')->with('success', 'Data Pasangan Berhasil di Hapus');
    }

    public function tambahAnak()
    {
        return view('keluarga.anak.tambah');
    }

    public function simpanAnak(Request $request)
    {
        $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$pegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];

        $validatedData = $request->validate([
            'nama_anak' => 'required|max:255',
            'nik' => 'required',
            'anak_nmr' => 'required',
            'jk' => 'required',
            'no_telp' => 'required',
            'agama' => 'required|max:255',
            'tgl_lahir' => 'required|max:255',
            'status' => 'required|max:255',
        ]);


        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['pegawai_id'] = $pegawai_id;

        Anak::create($validatedData);

        return redirect('/anak')->with('success', 'Data Anak Berhasil di Tambah');
    }

    public function detailAnak($id, Anak $anak)
    {
        $id = Crypt::decrypt($id);
        $anak = Anak::findOrFail($id);

        return view('keluarga.anak.detail', [
            'anak' => $anak
        ]);
    }

    public function editAnak($id, Anak $anak)
    {
        $id = Crypt::decrypt($id);
        $anak = Anak::findOrFail($id);

        return view('keluarga.anak.edit', [
            'anak' => $anak
        ]);
    }

    public function updateAnak($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nama_anak' => 'required|max:255',
            'nik' => 'required',
            'anak_nmr' => 'required',
            'jk' => 'required',
            'no_telp' => 'required',
            'agama' => 'required|max:255',
            'tgl_lahir' => 'required|max:255',
            'status' => 'required|max:255',
        ];

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$pegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];

        $validatedData['pegawai_id'] = $pegawai_id;

        $validatedData = $request->validate($rules);

        Anak::where('id', $id)
            ->update($validatedData);

        return redirect('/anak')->with('success', 'Data Anak Berhasil di Update');
    }

    public function hapusAnak($id)
    {
        $id = Crypt::decrypt($id);
        Anak::destroy($id);

        return redirect('/anak')->with('success', 'Data Anak Berhasil di Hapus');
    }
}
