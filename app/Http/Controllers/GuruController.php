<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Sekolah;
use App\Models\TMJabatan;
use App\Models\TrxGuruHonorer;
use App\Models\TrxPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function dataHonorer()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $not = TrxGuruHonorer::where('sekolah_id', $sekolah->id)->pluck('pegawai_id');

        $pegawai = Pegawai::where('sekolah_id', $sekolah->id)->where('golongan_guru', "Guru Honorer")->whereNotIn('id', $not)->get();

        $guru = TrxGuruHonorer::where('sekolah_id', $sekolah->id)->get();

        $tanggal = date_create();

        return view('guruHonorer.index', [
            'pegawai' => $pegawai,
            'guru' => $guru,
            'tanggal' => $tanggal
        ]);
    }

    public function tambahGajiHonorer(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'gaji_pokok' => 'required'
        ]);

        $validatedData['sekolah_id'] = $sekolah->id;

        TrxGuruHonorer::create($validatedData);

        return redirect('/dataGuruHonorer')->with('success', 'Gaji Guru Honorer Berhasil Ditammbah');
    }

    public function dataPegawai()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $tanggal = date_create();

        $not = TrxPegawai::where('sekolah_id', $sekolah->id)->pluck('pegawai_id');

        $pegawai = DB::table('tbl_pegawai')
            ->join('tbl_jabatan', 'tbl_pegawai.id', '=', 'tbl_jabatan.pegawai_id')
            ->join('tm_jabatan', 'tbl_jabatan.jabatan_id', '=', 'tm_jabatan.id')
            ->where('tbl_pegawai.sekolah_id', $sekolah->id)
            ->where('tbl_pegawai.golongan_guru', "Bukan Guru")
            ->whereNotIn('tbl_pegawai.id', $not)
            ->get();

        $guru = DB::table('trx_pegawai')
            ->select('trx_pegawai.id', 'trx_pegawai.gaji_pokok', 'tbl_pegawai.nama_lengkap', 'tbl_pegawai.golongan_guru', 'tm_jabatan.nama_jabatan')
            ->join('tbl_pegawai', 'trx_pegawai.pegawai_id', '=', 'tbl_pegawai.id')
            ->join('tbl_jabatan', 'trx_pegawai.pegawai_id', '=', 'tbl_jabatan.pegawai_id')
            ->join('tm_jabatan', 'tbl_jabatan.jabatan_id', '=', 'tm_jabatan.id')
            ->where('tbl_pegawai.sekolah_id', $sekolah->id)
            ->get();

        $id = TrxPegawai::where('sekolah_id', $sekolah->id)->pluck('id');

        // dd($guru);

        return view('guru.pegawai', [
            'pegawai' => $pegawai,
            'guru' => $guru,
            'tanggal' => $tanggal,
            'id' => $id
        ]);
    }

    public function tambahGajiPegawaiSekolah(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'gaji_pokok' => 'required'
        ]);

        $validatedData['sekolah_id'] = $sekolah->id;

        TrxPegawai::create($validatedData);

        return redirect('/dataPegawaiSekolah')->with('success', 'Gaji Pegawai Sekolah Berhasil Ditammbah');
    }

    public function inputGajiHonorer($id)
    {
        $id = Crypt::decrypt($id);
        $gaji = TrxGuruHonorer::findOrFail($id);

        $tanggal = date_create();

        return view('guruHonorer.gaji', [
            'gaji' => $gaji,
            'tanggal' => $tanggal
        ]);
    }

    public function simpanGajiHonorer(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $validatedData = $request->validate([
            'tanggal_penggajian' => 'required',
            'gaji_pokok' => 'required',
            'pegawai_id' => 'required',
            'user_id' => 'required'
        ]);

        $validatedData['sekolah_id'] = $sekolah->id;
        $validatedData['status'] = "Belum Dibayar";

        Gaji::create($validatedData);

        return redirect('/gajiPegawai')->with('success', 'Gaji Berhasil Ditammbah');
    }

    public function inputGajiPegawai($id)
    {
        $id = Crypt::decrypt($id);
        $gaji = TrxPegawai::findOrFail($id);

        $jabatan = Jabatan::where('pegawai_id', $gaji->pegawai_id)->pluck('jabatan_id');
        $nama_jabatan = TMJabatan::where('id', $jabatan)->pluck('nama_jabatan');

        $tanggal = date_create();

        return view('guru.gajiPegawai', [
            'gaji' => $gaji,
            'tanggal' => $tanggal,
            'nama_jabatan' => $nama_jabatan
        ]);
    }

    public function hapusGuruHonorer($id)
    {
        $id = Crypt::decrypt($id);

        TrxGuruHonorer::destroy($id);

        return redirect('/dataGuruHonorer')->with('success', 'Gaji Guru Honorer Berhasil Di Hapus');
    }

    public function editGuruHonorer($id)
    {
        $id = Crypt::decrypt($id);

        $honorer = TrxGuruHonorer::findOrFail($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $tanggal = date_create();

        return view('guruHonorer.edit', [
            'honorer' => $honorer,
            'tanggal' => $tanggal
        ]);
    }

    public function updateGuruHonorer(Request $request, $id)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $id = Crypt::decrypt($id);

        $rules = [
            'gaji_pokok' => 'required',
            'pegawai_id' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['sekolah_id'] = $sekolah->id;

        // dd($validatedData);

        TrxGuruHonorer::where('id', $id)
            ->update($validatedData);;

        return redirect('/dataGuruHonorer')->with('success', 'Gaji Guru Honorer Berhasil Di Update');
    }

    public function editPegawaiSekolah($id)
    {
        $id = Crypt::decrypt($id);

        $pegawai = TrxPegawai::findOrFail($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $tanggal = date_create();

        // dd($pegawai);

        return view('guru.editPegawaiSekolah', [
            'pegawai' => $pegawai,
            'tanggal' => $tanggal
        ]);
    }

    public function updatePegawaiSekolah(Request $request, $id)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $id = Crypt::decrypt($id);

        $rules = [
            'gaji_pokok' => 'required',
            'pegawai_id' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['sekolah_id'] = $sekolah->id;

        // dd($validatedData);

        TrxPegawai::where('id', $id)
            ->update($validatedData);;

        return redirect('/dataPegawaiSekolah')->with('success', 'Gaji Pegawai Sekolah Berhasil Di Update');
    }

    public function hapusPegawaiSekolah($id)
    {
        $id = Crypt::decrypt($id);

        TrxPegawai::destroy($id);

        // DB::table('trx_pegawai')->where('id', $id)->delete();

        return redirect('/dataPegawaiSekolah')->with('success', 'Gaji Pegawai Berhasil Di Hapus');
    }
}
