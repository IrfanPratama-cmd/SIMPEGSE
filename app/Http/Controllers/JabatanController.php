<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Sekolah;
use App\Models\TMJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class JabatanController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        return view('jabatan.index', [
            'jabatan' => TMJabatan::where('sekolah_id', $sekolah_id)->orderBy('nama_jabatan', 'asc')->paginate(6),
            'nama_sekolah' => $nama_sekolah
        ]);
    }

    public function tambahJabatan(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        $validatedData = $request->validate([
            'nama_jabatan' => 'required|max:255',
            'is_many' => 'required'
            // 'gaji_pokok' => 'required',
            // 'tunjangan_pasangan' => 'required',
            // 'tunjangan_anak' => 'required',
            // 'tunjangan_transport' => 'required',
        ]);

        $validatedData['sekolah_id'] = $sekolah_id;

        TMJabatan::create($validatedData);

        return redirect('/jabatan')->with('success', 'Jabatan Berhasil di Tambah');
    }

    public function hapusJabatan($id)
    {
        $id = Crypt::decrypt($id);
        TMJabatan::destroy($id);

        return redirect('/jabatan')->with('success', 'Jabatan Berhasil di Hapus');
    }

    public function editJabatan($id, Jabatan $jabatan)
    {
        $id = Crypt::decrypt($id);
        $jabatan = TMJabatan::findOrFail($id);

        return view('jabatan.edit', [
            'jabatan' => $jabatan
        ]);
    }

    public function updateJabatan($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nama_jabatan' => 'required|max:255',
            // 'gaji_pokok' => 'required',
            // 'tunjangan_pasangan' => 'required',
            // 'tunjangan_anak' => 'required',
            // 'tunjangan_transport' => 'required',
        ];

        $validatedData = $request->validate($rules);

        TMJabatan::where('id', $id)
            ->update($validatedData);

        return redirect('/jabatan')->with('success', 'Jabatan Berhasil di Update');
    }

    public function detailJabatan($id)
    {
        $id = Crypt::decrypt($id);

        // $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $jabatan = TMJabatan::findOrFail($id);

        return view('jabatan.detail', [
            'jabatan' => $jabatan
        ]);
    }

    public function jabatanPegawai()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $not = Jabatan::where('sekolah_id', $sekolah->id)->pluck('pegawai_id');
        $not2 = Jabatan::where('sekolah_id', $sekolah->id)->pluck('jabatan_id');

        $notJ = TMJabatan::where('sekolah_id', $sekolah->id)->where('is_many', "0")->whereIn('id', $not2)->pluck('id');

        $pegawai = Pegawai::where('sekolah_id', $sekolah->id)->whereNotIn('id', $not)->get();
        $TMjabatan = TMJabatan::where('sekolah_id', $sekolah->id)->whereNotIn('id', $notJ)->get();

        return view('jabatan.pegawai', [
            'jabatan' => Jabatan::where('sekolah_id', $sekolah->id)->orderBy('pegawai_id', 'asc')->paginate(6),
            'nama_sekolah' => $sekolah->nama_sekolah,
            'pegawai' => $pegawai,
            'TMjabatan' => $TMjabatan
        ]);
    }

    public function tambahJabatanPegawai(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'jabatan_id' => 'required',
        ]);

        $validatedData['sekolah_id'] = $sekolah_id;

        Jabatan::create($validatedData);

        return redirect('/jabatanPegawai')->with('success', 'Jabatan Berhasil di Tambah');
    }

    public function hapusJabatanPegawai($id)
    {
        $id = Crypt::decrypt($id);
        Jabatan::destroy($id);

        return redirect('/jabatanPegawai')->with('success', 'Jabatan Berhasil di Hapus');
    }

    public function editJabatanPegawai($id, Jabatan $jabatan)
    {
        $id = Crypt::decrypt($id);
        $jabatan = Jabatan::findOrFail($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        $pegawai = Pegawai::where('sekolah_id', $sekolah_id)->get();
        $TMjabatan = TMJabatan::where('sekolah_id', $sekolah_id)->get();

        return view('jabatan.editPegawai', [
            'jabatan' => $jabatan,
            'pegawai' => $pegawai,
            'TMjabatan' => $TMjabatan
        ]);
    }

    public function updateJabatanPegawai($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'pegawai_id' => 'required',
            'jabatan_id' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Jabatan::where('id', $id)
            ->update($validatedData);

        return redirect('/jabatanPegawai')->with('success', 'Jabatan Berhasil di Update');
    }

    public function detailJabatanPegawai($id)
    {
        $id = Crypt::decrypt($id);

        $jabatan = Jabatan::findOrFail($id);

        return view('jabatan.detailPegawai', [
            'jabatan' => $jabatan
        ]);
    }
}
