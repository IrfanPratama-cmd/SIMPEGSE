<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\GuruPPPK;
use App\Models\Pegawai;
use App\Models\Sekolah;
use App\Models\SekolahGuruPPPK;
use App\Models\TrxPPPK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PppkController extends Controller
{
    public function index()
    {
        $pppk = GuruPPPK::all();

        return view('guruPPPK.index', [
            'pppk' => $pppk
        ]);
    }

    public function tambah(Request $request)
    {
        $validatedData = $request->validate([
            'golongan_pppk' => 'required'
        ]);

        GuruPPPK::create($validatedData);

        return redirect('/masterPppk')->with('success', 'Golongan Guru PPPK Berhasil Ditammbah');
    }

    public function guruPPPK()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $not = SekolahGuruPPPK::where('sekolah_id', $sekolah->id)->pluck('pppk_id');

        $pppk = GuruPPPK::whereNotIn('id', $not)->get();

        $guru = SekolahGuruPPPK::where('sekolah_id', $sekolah->id)->get();

        return view('sekolahPPPK.index', [
            'pppk' => $pppk,
            'guru' => $guru
        ]);
    }

    public function tambahGajiPPPK(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $validatedData = $request->validate([
            'pppk_id' => 'required',
            'gaji_pppk' => 'required'
        ]);

        $validatedData['sekolah_id'] = $sekolah->id;

        SekolahGuruPPPK::create($validatedData);

        return redirect('/guruPPPK')->with('success', 'Gaji Guru PPPK Berhasil Ditammbah');
    }

    public function dataPPPK()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $not = TrxPPPK::where('sekolah_id', $sekolah->id)->pluck('pegawai_id');

        $pppk = SekolahGuruPPPK::where('sekolah_id', $sekolah->id)->get();

        $guru = TrxPPPK::where('sekolah_id', $sekolah->id)->get();

        $pegawai = Pegawai::where('sekolah_id', $sekolah->id)->where('golongan_guru', "Guru PPPK")
            ->whereNotIn('id', $not)->get();

        // dd($guru);

        return view('guru.pppk', [
            'pegawai' => $pegawai,
            'guru' => $guru,
            'pppk' => $pppk
        ]);
    }

    public function tambahGuruPPPK(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $validatedData = $request->validate([
            'skh_pppk_id' => 'required',
            'pegawai_id' => 'required'
        ]);

        $validatedData['sekolah_id'] = $sekolah->id;

        TrxPPPK::create($validatedData);

        return redirect('/dataGuruPPPK')->with('success', 'Guru PPPK Berhasil Ditammbah');
    }

    public function inputGajiPPPK($id)
    {
        $id = Crypt::decrypt($id);
        $gaji = TrxPPPK::findOrFail($id);

        // dd($gaji);

        return view('guruPPPK.gaji', [
            'gaji' => $gaji
        ]);
    }

    public function simpanGajiPPPK(Request $request)
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

    public function editGuruPPPK($id)
    {
        $id = Crypt::decrypt($id);

        $pppk = TrxPPPK::findOrFail($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $golongan = SekolahGuruPPPK::where('sekolah_id', $sekolah->id)->get();

        return view('guruPPPK.edit', [
            'pppk' => $pppk,
            'golongan' => $golongan
        ]);
    }

    public function updateGuruPPPK(Request $request, $id)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $id = Crypt::decrypt($id);

        $rules = [
            'skh_pppk_id' => 'required',
            'pegawai_id' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['sekolah_id'] = $sekolah->id;

        // dd($validatedData);

        TrxPPPK::where('id', $id)
            ->update($validatedData);;

        return redirect('/dataGuruPPPK')->with('success', 'Gaji Guru PPPK Berhasil Di Update');
    }

    public function hapusGuruPPPK($id)
    {
        $id = Crypt::decrypt($id);

        TrxPPPK::destroy($id);

        return redirect('/dataGuruPPK')->with('success', 'Gaji Guru PPPK Berhasil Di Hapus');
    }

    public function editPPPK($id)
    {
        $id = Crypt::decrypt($id);

        $pppk = SekolahGuruPPPK::findOrFail($id);

        return view('sekolahPPPK.edit', [
            'pppk' => $pppk
        ]);
    }

    public function updateGajiPPPK(Request $request, $id)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $id = Crypt::decrypt($id);

        $rules = [
            'pppk_id' => 'required',
            'gaji_pppk' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['sekolah_id'] = $sekolah->id;

        // dd($validatedData);

        SekolahGuruPPPK::where('id', $id)
            ->update($validatedData);;

        return redirect('/guruPPPK')->with('success', 'Gaji Guru PPPK Berhasil Di Update');
    }
}
