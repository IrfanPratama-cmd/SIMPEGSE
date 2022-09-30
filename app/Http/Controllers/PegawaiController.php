<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Diklat;
use App\Models\Divisi;
use App\Models\Organisasi;
use App\Models\Ortu;
use App\Models\Pasangan;
use App\Models\Pegawai;
use App\Models\Pendidikan;
use App\Models\Sekolah;
use App\Models\Seminar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function dataPegawai()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $localtime = $date->format('H:i:s');

        $awal  = date_create('1988-08-10');
        $tanggal = date_create();

        $diff  = date_diff($sekolah->created_at, $tanggal);
        // dd($diff);

        return view('dashboard.data-pegawai', [
            'pegawai' => Pegawai::where('sekolah_id', $sekolah->id)->orderBy('nama_lengkap', 'asc')->paginate(6),
            'nama_sekolah' => $sekolah->nama_sekolah,
            'tanggal' => $tanggal
        ]);
    }

    public function cariPegawai(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $tanggal = date_create();

        $cari = $request->cariPegawai;

        $pegawai = Pegawai::where('nama_lengkap', 'like', "%" . $cari . "%")->where('sekolah_id', $sekolah->id)->paginate(5);

        return view('dashboard.data-pegawai', [
            'pegawai' => $pegawai,
            'tanggal' => $tanggal,
            'nama_sekolah' => $sekolah->nama_sekolah
        ]);
    }

    public function detailPegawai($id, Pegawai $pegawai)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);

        $pegawai2 = Pegawai::where('id', $id)->count();
        $pendidikan = Pendidikan::where('pegawai_id', $id)->count();
        $organisasi = Organisasi::where('pegawai_id', $id)->count();
        $ortu = Ortu::where('pegawai_id', $id)->count();
        $pasangan = Pasangan::where('pegawai_id', $id)->count();
        $anak = Anak::where('pegawai_id', $id)->count();

        return view('pegawai.index', [
            'pegawai' => $pegawai,
            'pegawai2' => $pegawai2,
            'pendidikan' => $pendidikan,
            'organisasi' => $organisasi,
            'ortu' => $ortu,
            'pasangan' => $pasangan,
            'anak' => $anak,
        ]);
    }

    public function profilePegawai($id, Pegawai $pegawai)
    {
        $id = Crypt::decrypt($id);

        $pegawai = DB::table('tbl_pegawai')
            ->join('users', 'tbl_pegawai.user_id', '=', 'users.id')
            ->leftjoin('tbl_jabatan', 'tbl_pegawai.id', '=', 'tbl_jabatan.pegawai_id')
            ->leftJoin('tm_jabatan', 'tbl_jabatan.jabatan_id', '=', 'tm_jabatan.id')
            ->leftJoin('trx_guru_asn', 'tbl_pegawai.id', '=', 'trx_guru_asn.pegawai_id')
            ->leftJoin('skh_guru_asn', 'trx_guru_asn.skh_asn_id', '=', 'skh_guru_asn.id')
            ->leftJoin('tbl_guru_asn', 'skh_guru_asn.asn_id', '=', 'tbl_guru_asn.id')
            ->leftJoin('trx_guru_pppk', 'tbl_pegawai.id', '=', 'trx_guru_pppk.pegawai_id')
            ->leftJoin('skh_guru_pppk', 'trx_guru_pppk.skh_pppk_id', '=', 'skh_guru_pppk.id')
            ->leftJoin('tbl_guru_pppk', 'skh_guru_pppk.pppk_id', '=', 'tbl_guru_pppk.id')
            ->where('tbl_pegawai.id', $id)
            ->first();
        // $pegawai = Pegawai::findOrFail($id);

        $tanggal = date_create();

        $masuk = Pegawai::findOrFail($id);

        $diff  = date_diff($masuk->created_at, $tanggal);

        $foto = $masuk->foto_profile;

        $ktp = $masuk->foto_ktp;

        // dd($diff);

        return view('dashboard.detailPegawai.detailProfile', [
            'pegawai' => $pegawai,
            'diff' => $diff,
            'foto' => $foto,
            'ktp' => $ktp
        ]);
    }

    public function dataKeluarga(Pegawai $pegawai, $id)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);

        return view('pegawai.keluarga.index', [
            'pegawai' => $pegawai,
            "active" => "index"
        ]);
    }

    public function ortu($id, Ortu $ortu)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);
        $ortu = Ortu::where('pegawai_id', $id)->get();

        return view('pegawai.keluarga.ortu', [
            'ortu' => $ortu,
            'pegawai' => $pegawai,
            "active" => "ortu"
        ]);
    }

    public function pasangan($id, Pasangan $pasangan)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);
        $pasangan = Pasangan::where('pegawai_id', $id)->get();

        return view('pegawai.keluarga.pasangan', [
            'pasangan' => $pasangan,
            'pegawai' => $pegawai,
            "active" => "pasangan"
        ]);
    }

    public function anak($id, Anak $anak)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);
        $anak = Anak::where('pegawai_id', $id)->get();

        return view('pegawai.keluarga.anak', [
            'anak' => $anak,
            'pegawai' => $pegawai,
            "active" => "anak"
        ]);
    }

    public function detailOrtuPegawai($id, Ortu $ortu)
    {
        $id = Crypt::decrypt($id);
        $ortu = Ortu::findOrFail($id);

        return view('pegawai.keluarga.detailOrtu', [
            'ortu' => $ortu
        ]);
    }

    public function detailPasanganPegawai($id, Pasangan $pasangan)
    {
        $id = Crypt::decrypt($id);
        $pasangan = Pasangan::findOrFail($id);

        return view('pegawai.keluarga.detailOrtu', [
            'pasangan' => $pasangan
        ]);
    }

    public function detailAnakPegawai($id, Anak $anak)
    {
        $id = Crypt::decrypt($id);
        $anak = Anak::findOrFail($id);

        return view('pegawai.keluarga.detailAnak', [
            'anak' => $anak
        ]);
    }

    public function pendidikan($id, Pendidikan $pendidikan)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);
        $pendidikan = Pendidikan::where('pegawai_id', $id)->get();

        return view('pegawai.pendidikan', [
            'pendidikan' => $pendidikan,
            'pegawai' => $pegawai
        ]);
    }

    public function detailPendidikan($id, Pendidikan $pendidikan)
    {
        $id = Crypt::decrypt($id);
        $pendidikan = Pendidikan::findOrFail($id);

        return view('pegawai.detailPendidikan', [
            'pendidikan' => $pendidikan
        ]);
    }

    public function organisasi($id, Organisasi $organisasi)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);
        $organisasi = Organisasi::where('pegawai_id', $id)->get();

        return view('pegawai.organisasi', [
            'organisasi' => $organisasi,
            'pegawai' => $pegawai
        ]);
    }

    public function detailOrganisasi($id, Organisasi $organisasi)
    {
        $id = Crypt::decrypt($id);
        $organisasi = Organisasi::findOrFail($id);

        return view('pegawai.detailOrganisasi', [
            'organisasi' => $organisasi
        ]);
    }

    public function diklat($id, Diklat $diklat)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);
        $diklat = Diklat::where('pegawai_id', $id)->get();

        return view('pegawai.diklat', [
            'diklat' => $diklat,
            'pegawai' => $pegawai
        ]);
    }

    public function detailDiklat($id, Diklat $diklat)
    {
        $id = Crypt::decrypt($id);
        $diklat = Diklat::findOrFail($id);

        return view('pegawai.detailDiklat', [
            'diklat' => $diklat
        ]);
    }

    public function seminar($id, Seminar $seminar)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);
        $seminar = Seminar::where('pegawai_id', $id)->get();

        return view('pegawai.seminar', [
            'seminar' => $seminar,
            'pegawai' => $pegawai
        ]);
    }

    public function detailSeminar($id, Seminar $seminar)
    {
        $id = Crypt::decrypt($id);
        $seminar = Seminar::findOrFail($id);

        return view('pegawai.detailSeminar', [
            'seminar' => $seminar
        ]);
    }
    public function editPegawai($id, Pegawai $pegawai)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);

        $tanggal = date_create();

        return view('dashboard.editPegawai', [
            'pegawai' => $pegawai,
            'tanggal' => $tanggal
        ]);
    }

    public function updatePegawai($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nama_lengkap' => 'required',
            'golongan_guru' => 'required',
            'created_at' => 'required',
            'status' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Pegawai::where('id', $id)
            ->update($validatedData);

        return redirect('daftar-pegawai')->with('success', 'Pegawai Berhasil di Update');
    }
}
