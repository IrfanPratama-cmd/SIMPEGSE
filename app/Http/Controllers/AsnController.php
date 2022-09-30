<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\GuruASN;
use App\Models\Pegawai;
use App\Models\Sekolah;
use App\Models\SekolahGuruASN;
use App\Models\TrxASN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AsnController extends Controller
{
    public function index()
    {
        $asn = GuruASN::all();

        return view('guruASN.index', [
            'asn' => $asn
        ]);
    }

    public function tambah(Request $request)
    {
        $validatedData = $request->validate([
            'golongan_asn' => 'required'
        ]);

        GuruASN::create($validatedData);

        return redirect('/masterAsn')->with('success', 'Golonan Guru PNS Berhasil Ditammbah');
    }

    public function guruASN()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $not = SekolahGuruASN::where('sekolah_id', $sekolah->id)->pluck('asn_id');

        $asn = GuruASN::whereNotIn('id', $not)->get();

        $guru = SekolahGuruASN::where('sekolah_id', $sekolah->id)->get();

        return view('sekolahASN.index', [
            'asn' => $asn,
            'guru' => $guru
        ]);
    }

    public function tambahGajiASN(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $validatedData = $request->validate([
            'asn_id' => 'required',
            'gaji_asn' => 'required'
        ]);

        $validatedData['sekolah_id'] = $sekolah->id;

        SekolahGuruASN::create($validatedData);

        return redirect('/guruASN')->with('success', 'Gaji Guru PNS Berhasil Ditammbah');
    }

    public function dataASN()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $not = TrxASN::where('sekolah_id', $sekolah->id)->pluck('pegawai_id');

        $asn = SekolahGuruASN::where('sekolah_id', $sekolah->id)->get();

        $guru = TrxASN::where('sekolah_id', $sekolah->id)->get();

        $pegawai = Pegawai::where('sekolah_id', $sekolah->id)->where('golongan_guru', "Guru PNS")
            ->whereNotIn('id', $not)->get();

        // dd($guru);

        return view('guru.asn', [
            'pegawai' => $pegawai,
            'guru' => $guru,
            'asn' => $asn
        ]);
    }

    public function tambahGuruASN(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $validatedData = $request->validate([
            'skh_asn_id' => 'required',
            'pegawai_id' => 'required'
        ]);

        $validatedData['sekolah_id'] = $sekolah->id;

        TrxASN::create($validatedData);

        return redirect('/dataGuruASN')->with('success', 'Gaji Guru PNS Berhasil Ditammbah');
    }

    public function inputGajiPNS($id)
    {
        $id = Crypt::decrypt($id);
        $gaji = TrxASN::findOrFail($id);

        return view('guruASN.gaji', [
            'gaji' => $gaji
        ]);
    }

    public function simpanGajiPNS(Request $request)
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

        return redirect('/gajiPegawai')->with('success', 'Gaji Berhasil Ditambah');
    }


    public function hapusGuruPNS($id)
    {
        $id = Crypt::decrypt($id);

        TrxASN::destroy($id);

        return redirect('/dataGuruASN')->with('success', 'Gaji Guru PNS Berhasil Di Hapus');
    }

    public function editGuruPNS($id)
    {
        $id = Crypt::decrypt($id);

        $asn = TrxASN::findOrFail($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $golongan = SekolahGuruASN::where('sekolah_id', $sekolah->id)->get();

        return view('guruASN.edit', [
            'asn' => $asn,
            'golongan' => $golongan
        ]);
    }

    public function updateGuruPNS(Request $request, $id)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $id = Crypt::decrypt($id);

        $rules = [
            'skh_asn_id' => 'required',
            'pegawai_id' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['sekolah_id'] = $sekolah->id;

        // dd($validatedData);

        TrxASN::where('id', $id)
            ->update($validatedData);;

        return redirect('/dataGuruASN')->with('success', 'Gaji Guru PNS Berhasil Di Update');
    }

    public function editASN($id)
    {
        $id = Crypt::decrypt($id);

        $asn = SekolahGuruASN::findOrFail($id);

        return view('sekolahASN.edit', [
            'asn' => $asn
        ]);
    }

    public function updateGajiASN(Request $request, $id)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $id = Crypt::decrypt($id);

        $rules = [
            'asn_id' => 'required',
            'gaji_asn' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['sekolah_id'] = $sekolah->id;

        // dd($validatedData);

        SekolahGuruASN::where('id', $id)
            ->update($validatedData);;

        return redirect('/guruASN')->with('success', 'Gaji Guru PNS Berhasil Di Update');
    }
}
