<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Cuti;
use App\Models\Divisi;
use App\Models\Gaji;
use App\Models\Jabatan;
use App\Models\Organisasi;
use App\Models\Ortu;
use App\Models\Pasangan;
use App\Models\Pegawai;
use App\Models\Pendidikan;
use App\Models\Presensi;
use App\Models\Sekolah;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\TMJabatan;
use App\Models\TMMapel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateTimeZone;
use Stevebauman\Location\Facades\Location;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified']);
    }

    public function index()
    {
        if (auth()->user()->role == "Admin") {
            $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
            $objectToArray = (array)$sekolah;
            $get1 = $objectToArray[0];
            $get2 = (array)$get1;
            $sekolah_id = $get2['id'];
            $nama_sekolah = $get2['nama_sekolah'];

            $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
            $minggu = Carbon::now()->isoFormat('dddd') == "Minggu";
            $sabtu = Carbon::now()->isoFormat('dddd') == "Sabtu";

            $siswa = Siswa::where('sekolah_id', $sekolah_id)->count();

            $dataUser = User::where('sekolah_id', $sekolah_id)->count();
            $dataPegawai = Pegawai::where('sekolah_id', $sekolah_id)->count();
            $dataMapel = TMMapel::where('sekolah_id', $sekolah_id)->count();
            $dataJabatan = TMJabatan::where('sekolah_id', $sekolah_id)->count();
            $bulan = Carbon::now()->format('m');

            $pegawaiPresensi = Presensi::where('tgl', $tanggal)->where('sekolah_id', $sekolah_id)->count();
            $blmPresensi = $dataPegawai - $pegawaiPresensi;

            $pengajuanCuti = Cuti::where('status', "Menunggu")->where('sekolah_id', $sekolah_id)->count();
            $terimaCuti = Cuti::where('status', "Disetujui")->where('sekolah_id', $sekolah_id)->count();
            $tolakCuti = Cuti::where('status', "Ditolak")->where('sekolah_id', $sekolah_id)->count();

            if (Auth::check()) {
                return view('dashboard.index', [
                    'dataUser' => $dataUser,
                    'dataPegawai' => $dataPegawai,
                    'dataMapel' => $dataMapel,
                    'dataJabatan' => $dataJabatan,
                    'pegawaiPresensi' => $pegawaiPresensi,
                    'blmPresensi' => $blmPresensi,
                    'tanggal' => $tanggal,
                    'minggu' => $minggu,
                    'sabtu' => $sabtu,
                    'pengajuanCuti' => $pengajuanCuti,
                    'terimaCuti' => $terimaCuti,
                    'tolakCuti' => $tolakCuti,
                    'setting' => Setting::all(),
                    'tanggal' => $tanggal,
                    'siswa' => $siswa
                ]);
            }
        } elseif (auth()->user()->role == "Pegawai") {
            $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
            $objectToArray = (array)$pegawai;
            $get1 = $objectToArray[0];
            $get2 = (array)$get1;
            $sekolah_id = $get2['sekolah_id'];

            $sekolah = Sekolah::where('id', $sekolah_id)->get()->toArray();
            $objectToArray = (array)$sekolah;
            $get1 = $objectToArray[0];
            $get2 = (array)$get1;
            $nama_sekolah = $get2['nama_sekolah'];

            $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
            $minggu = Carbon::now()->isoFormat('dddd') == "Minggu";
            $sabtu = Carbon::now()->isoFormat('dddd') == "Sabtu";

            $bulan2 = Carbon::now()->isoFormat('MMMM Y');

            $setting = Setting::where('sekolah_id', $sekolah_id)->get();

            $pegawai = Pegawai::where('user_id', auth()->user()->id)->count();
            $pendidikan = Pendidikan::where('user_id', auth()->user()->id)->count();
            $organisasi = Organisasi::where('user_id', auth()->user()->id)->count();
            $ortu = Ortu::where('user_id', auth()->user()->id)->count();
            $pasangan = Pasangan::where('user_id', auth()->user()->id)->count();
            $anak = Anak::where('user_id', auth()->user()->id)->count();

            $timezone = 'Asia/Jakarta';
            $date = new DateTime('now', new DateTimeZone($timezone));
            $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
            $localtime = $date->format('H:i:s');

            $cekPresensi = Presensi::where('user_id', auth()->user()->id)->where('tgl', $tanggal)->count();
            $presensi = Presensi::where('user_id', auth()->user()->id)->where('tgl', $tanggal)->get();

            $location = Location::get('36.65.126.188');

            // $location = Location::get()

            if (Auth::check()) {
                return view('dashboard.index', [
                    'tanggal' => $tanggal,
                    'minggu' => $minggu,
                    'sabtu' => $sabtu,
                    // 'gajiDibayar' => $gajiDibayar,
                    // 'gajiBlmDibayar' => $gajiBlmDibayar,
                    'bulan' => $bulan2,
                    'pegawai' => $pegawai,
                    'pendidikan' => $pendidikan,
                    'organisasi' => $organisasi,
                    'ortu' => $ortu,
                    'pasangan' => $pasangan,
                    'anak' => $anak,
                    'localtime' => $localtime,
                    'setting' => $setting,
                    'cekPresensi' => $cekPresensi,
                    'presensi' => $presensi,
                    'tanggal' => $tanggal,
                    'nama_sekolah' => $nama_sekolah,
                    'location' => $location
                ]);
            }
        } elseif (auth()->user()->role == "Siswa") {
            $siswa = Siswa::where('user_id', auth()->user()->id)->first();
            $sekolah = Sekolah::where('id', $siswa->sekolah_id)->first();
            if (Auth::check()) {
                return view('dashboard.index', [
                    'nama_sekolah' => $sekolah->nama_sekolah
                ]);
            }
        } elseif (auth()->user()->role == "Super Admin") {
            if (Auth::check()) {
                return view('dashboard.index');
            }
        }
    }
}
