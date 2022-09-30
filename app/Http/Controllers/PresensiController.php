<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\Sekolah;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Crypt;
use Response;
use Illuminate\Support\Facades\Redirect;
use Stevebauman\Location\Facades\Location;

class PresensiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        $sekolah = Sekolah::where('id', $pegawai->sekolah_id)->first();

        $setting = Setting::where('sekolah_id', $sekolah->id)->get();

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        // $tanggal = $date->format('Y-m-d');
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $localtime = $date->format('H:i:s');

        $location = Location::get('36.65.126.188');

        // $location = Location::get()

        $minggu = Carbon::now()->isoFormat('dddd') == "Minggu";
        $sabtu = Carbon::now()->isoFormat('dddd') == "Sabtu";

        $cekPresensi = Presensi::where('user_id', auth()->user()->id)->where('tgl', $tanggal)->count();
        $presensi = Presensi::where('user_id', auth()->user()->id)->where('tgl', $tanggal)->get();

        return view('presensi.index', [
            'localtime' => $localtime,
            'setting' => $setting,
            'cekPresensi' => $cekPresensi,
            'presensi' => $presensi,
            'tanggal' => $tanggal,
            'minggu' => $minggu,
            'sabtu' => $sabtu,
            'location' => $location
        ]);
    }

    public function inputPresensi(Request $request)
    {
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        // $tanggal = $date->format('Y-m-d');
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $localtime = $date->format('H:i:s');

        $location = Location::get('36.65.126.188');

        // $location = Location::get();

        $validatedData = $request->validate([
            'jam_presensi' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'status' => 'required'
        ]);

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$pegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];
        $sekolah_id = $get2['sekolah_id'];

        $validatedData['pegawai_id'] = $pegawai_id;

        $validatedData['sekolah_id'] = $sekolah_id;

        $validatedData['user_id'] = auth()->user()->id;

        $validatedData['tgl'] = $tanggal;

        $validatedData['countryName'] = $location->countryName;
        $validatedData['countryCode'] = $location->countryCode;
        $validatedData['regionName'] = $location->regionName;
        $validatedData['cityName'] = $location->cityName;
        $validatedData['latitude'] = $location->latitude;
        $validatedData['longitude'] = $location->longitude;

        Presensi::create($validatedData);


        return Redirect::back()->with('success', 'Presensi Berhasil');
    }

    public function izin()
    {
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        // $tanggal = $date->format('Y-m-d');
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $localtime = $date->format('H:i:s');

        $cekIzin = Izin::where('user_id', auth()->user()->id)->where('tgl', $tanggal)->count();
        $izin = Izin::where('user_id', auth()->user()->id)->where('tgl', $tanggal)->get();

        // dd($cekIzin);

        $cekPresensi = Presensi::where('user_id', auth()->user()->id)->where('tgl', $tanggal)->count();
        $presensi = Presensi::where('user_id', auth()->user()->id)->where('tgl', $tanggal)->get();

        return view('presensi.ijin', [
            'localtime' => $localtime,
            'tanggal' => $tanggal,
            'cekIzin' => $cekIzin,
            'izin' => $izin,
            'cekPresensi' => $cekPresensi,
            'presensi' => $presensi
        ]);
    }

    public function inputIzin(Request $request)
    {
        $validatedData2 = $request->validate([
            'alasan' => 'required|max:255',
        ]);

        $data = $request->all();
        $createPresensi = $this->create($data);

        $validatedData2['pegawai_id'] = $createPresensi->pegawai_id;

        $validatedData2['user_id'] = auth()->user()->id;

        $validatedData2['presensi_id'] = $createPresensi->id;

        $validatedData2['tgl'] = $createPresensi->tgl;

        $validatedData2['status'] = "Menunggu";

        $file = $request->file('bukti');

        $bukti = $file->getClientOriginalName();

        $file->move('izin', $file->getClientOriginalName());

        $validatedData2['bukti'] = $bukti;

        Izin::create($validatedData2);

        return Redirect::back()->with('success', 'Presensi Berhasil');
    }

    public function create(array $data)
    {
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        // $tanggal = $date->format('Y-m-d');
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $localtime = $date->format('H:i:s');

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$pegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];

        return Presensi::create([
            'user_id' => auth()->user()->id,
            'pegawai_id' => $pegawai_id,
            'jam_presensi' => $data['jam_presensi'],
            'tgl' => $data['tgl'],
            'keterangan' => $data['keterangan']
        ]);
    }

    public function rekapPresensi()
    {
        $bulan = Carbon::now()->format('m');

        $totalpresensi = Presensi::whereMonth('created_at', '=', $bulan)->where('user_id', auth()->user()->id)->count();
        $hadir = Presensi::where('user_id', auth()->user()->id)->where('keterangan', "Hadir")->whereMonth('created_at', '=', $bulan)->count();
        $terlambat = Presensi::where('user_id', auth()->user()->id)->where('keterangan', "Terlambat")->whereMonth('created_at', '=', $bulan)->count();
        $izin = Presensi::where('user_id', auth()->user()->id)->where('keterangan', "Izin")
            ->whereMonth('created_at', '=', $bulan)->count();
        $sakit = Presensi::where('user_id', auth()->user()->id)->where('keterangan', "Sakit")
            ->whereMonth('created_at', '=', $bulan)->count();
        $alpha = Presensi::where('user_id', auth()->user()->id)->where('keterangan', "Alpha")
            ->whereMonth('created_at', '=', $bulan)->count();

        $presensi = Presensi::where('user_id', auth()->user()->id)
            ->whereMonth('created_at', '=', $bulan)->paginate(5);

        $totalHadir = $hadir + $terlambat;

        return view('presensi.rekap', [
            "totalpresensi" => $totalpresensi,
            "hadir" => $totalHadir,
            "izin" => $izin,
            // "terlambat" => $terlambat,
            "sakit" => $sakit,
            "alpha" => $alpha,
            'presensi' => $presensi
        ]);
    }

    public function presensiBulan(Request $request)
    {
        $bulan = $request->bulan;

        $totalpresensi = Presensi::where('user_id', auth()->user()->id)
            ->whereMonth('created_at', '=', $bulan)->count();
        $hadir = Presensi::where('user_id', auth()->user()->id)->where('keterangan', "Hadir")
            ->whereMonth('created_at', '=', $bulan)->count();
        $terlambat = Presensi::where('user_id', auth()->user()->id)->where('keterangan', "Terlambat")
            ->whereMonth('created_at', '=', $bulan)->count();
        $izin = Presensi::where('user_id', auth()->user()->id)->where('keterangan', "Izin")
            ->whereMonth('created_at', '=', $bulan)->count();
        $sakit = Presensi::where('user_id', auth()->user()->id)->where('keterangan', "Sakit")
            ->whereMonth('created_at', '=', $bulan)->count();
        $alpha = Presensi::where('user_id', auth()->user()->id)->where('keterangan', "Alpha")
            ->whereMonth('created_at', '=', $bulan)->count();

        $presensi = Presensi::where('user_id', auth()->user()->id)
            ->whereMonth('created_at', '=', $bulan)->paginate(31);

        $totalHadir = $hadir + $terlambat;

        return view('presensi.rekap', [
            "totalpresensi" => $totalpresensi,
            "hadir" => $totalHadir,
            "izin" => $izin,
            "sakit" => $sakit,
            "alpha" => $alpha,
            'presensi' => $presensi
        ]);
    }

    public function dataPresensi()
    {
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        // $tanggal = $date->format('Y-m-d');
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $localtime = $date->format('H:i:s');

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];

        $pegawai = Pegawai::where('sekolah_id', $sekolah_id)->count();
        $pegawaiPresensi = Presensi::where('sekolah_id', $sekolah_id)->where('tgl', $tanggal)->count();
        $belumPresensi = Pegawai::where('sekolah_id', $sekolah_id)->whereNotIn('id', Presensi::where('sekolah_id', $sekolah_id)
            ->where('tgl', $tanggal)->pluck('pegawai_id'))->get();
        $blmPresensi = $pegawai - $pegawaiPresensi;

        // dd($belumPresensi);

        $minggu = Carbon::now()->isoFormat('dddd') == "Minggu";
        $sabtu = Carbon::now()->isoFormat('dddd') == "Sabtu";

        // dd($belumPresensi);

        $presensi = Presensi::where('tgl', $tanggal)->where('sekolah_id', $sekolah_id)->paginate(6);

        return view('presensi.admin.index', [
            'presensi' => $presensi,
            'tanggal' => $tanggal,
            'pegawai' => $pegawai,
            'pegawaiPresensi' => $pegawaiPresensi,
            'blmPresensi' => $blmPresensi,
            'minggu' => $minggu,
            'sabtu' => $sabtu,
            'belum' => $belumPresensi
        ]);
    }

    public function izinPegawai()
    {
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        // $tanggal = $date->format('Y-m-d');
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $localtime = $date->format('H:i:s');

        $izin = Izin::where('tgl', $tanggal)->paginate(6);
        return view('presensi.admin.ijin', [
            'izin' => $izin,
            'tanggal' => $tanggal
        ]);
    }

    public function terimaIzin($id, Request $request)
    {
        $rules = [
            'status' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Izin::where('id', $id)->update($validatedData);

        return Redirect::back()->with('success', 'Izin Diterima');
    }

    public function tolakIzin($id, Request $request)
    {
        $rules = [
            'status' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Izin::where('id', $id)->update($validatedData);

        return Redirect::back()->with('success', 'Izin Ditolak');
    }

    public function downloadBukti($bukti)
    {
        $filepath = public_path('izin' . '/' . $bukti);
        return Response::download($filepath);
    }

    public function rekapPresensiAdmin()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $bulan = Carbon::now()->format('m');

        $pegawai = Pegawai::where('sekolah_id', $sekolah_id)->paginate(6);

        $totalpresensi = Presensi::whereMonth('created_at', '=', $bulan)->count();
        $hadir = Presensi::where('keterangan', "Hadir")
            ->whereMonth('created_at', '=', $bulan)->count();
        $terlambat = Presensi::where('keterangan', "Terlambat")
            ->whereMonth('created_at', '=', $bulan)->count();
        $izin = Presensi::where('keterangan', "Izin")
            ->whereMonth('created_at', '=', $bulan)->count();
        $sakit = Presensi::where('keterangan', "Sakit")
            ->whereMonth('created_at', '=', $bulan)->count();
        $alpha = Presensi::where('keterangan', "Alpha")
            ->whereMonth('created_at', '=', $bulan)->count();

        $presensi = Presensi::whereMonth('created_at', '=', $bulan)->paginate(5);

        $totalHadir = $hadir + $terlambat;


        return view('presensi.admin.rekap', [
            "totalpresensi" => $totalpresensi,
            "hadir" => $totalHadir,
            "izin" => $izin,
            // "terlambat" => $terlambat,
            "sakit" => $sakit,
            "alpha" => $alpha,
            'presensi' => $presensi,
            'pegawai' => $pegawai
        ]);
    }

    public function cariPresensiBulan(Request $request)
    {
        $bulan = $request->bulan;

        $totalpresensi = Presensi::whereMonth('created_at', '=', $bulan)->count();
        $hadir = Presensi::where('keterangan', "Hadir")
            ->whereMonth('created_at', '=', $bulan)->count();
        $terlambat = Presensi::where('keterangan', "Terlambat")
            ->whereMonth('created_at', '=', $bulan)->count();
        $izin = Presensi::where('keterangan', "Izin")
            ->whereMonth('created_at', '=', $bulan)->count();
        $sakit = Presensi::where('keterangan', "Sakit")
            ->whereMonth('created_at', '=', $bulan)->count();
        $alpha = Presensi::where('keterangan', "Alpha")
            ->whereMonth('created_at', '=', $bulan)->count();

        $presensi = Presensi::whereMonth('created_at', '=', $bulan)->paginate(5);

        $totalHadir = $hadir + $terlambat;


        return view('presensi.admin.rekap', [
            "totalpresensi" => $totalpresensi,
            "hadir" => $totalHadir,
            "izin" => $izin,
            // "terlambat" => $terlambat,
            "sakit" => $sakit,
            "alpha" => $alpha,
            'presensi' => $presensi
        ]);
    }

    public function rekapPresensiHarian()
    {
        // $bulan = Carbon::now()->format('m');
        $hari = Carbon::now()->format('d');

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $totalpresensi = Presensi::whereDay('created_at', '=', $hari)->where('sekolah_id', $sekolah->id)->count();
        $hadir = Presensi::where('keterangan', "Hadir")->whereDay('created_at', '=', $hari)->count();
        $terlambat = Presensi::where('keterangan', "Terlambat")->whereDay('created_at', '=', $hari)->count();
        $izin = Presensi::where('keterangan', "Izin")->whereDay('created_at', '=', $hari)->count();
        $sakit = Presensi::where('keterangan', "Sakit")->whereDay('created_at', '=', $hari)->count();
        $alpha = Presensi::where('keterangan', "Alpha")->whereDay('created_at', '=', $hari)->count();

        $presensi = Presensi::whereDay('created_at', '=', $hari)->where('sekolah_id', $sekolah->id)->paginate(5);

        $pegawai = Pegawai::where('sekolah_id', $sekolah->id)->count();
        $pegawaiPresensi = Presensi::whereDate('created_at', '=', $hari)->where('sekolah_id', $sekolah->id)->count();
        $blmPresensi = $pegawai - $totalpresensi;

        $totalHadir = $hadir + $terlambat;

        // dd($totalpresensi);

        return view('presensi.admin.rekapHarian', [
            "totalpresensi" => $totalpresensi,
            "hadir" => $totalHadir,
            "izin" => $izin,
            // "terlambat" => $terlambat,
            "sakit" => $sakit,
            "alpha" => $alpha,
            'presensi' => $presensi,
            'pegawai' => $pegawai,
            'pegawaiPresensi' => $pegawaiPresensi,
            'blmPresensi' => $blmPresensi,
            'hari' => $hari
        ]);
    }

    public function cariPresensiHarian(Request $request)
    {
        $hari = $request->hari;

        $totalpresensi = Presensi::whereDate('created_at', '=', $hari)->count();
        $presensi = Presensi::whereDate('created_at', '=', $hari)->paginate(5);

        $pegawai = Pegawai::count();
        $pegawaiPresensi = Presensi::whereDate('created_at', '=', $hari)->count();
        $blmPresensi = $pegawai - $pegawaiPresensi;

        // dd($presensi);

        return view('presensi.admin.cariRekapHarian', [
            "totalpresensi" => $totalpresensi,
            'presensi' => $presensi,
            'pegawai' => $pegawai,
            'pegawaiPresensi' => $pegawaiPresensi,
            'blmPresensi' => $blmPresensi,
            'hari' => $hari
        ]);
    }

    public function rekapIzin()
    {
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = Carbon::now()->isoFormat(' MMMM ');
        $localtime = $date->format('H:i:s');

        $bulan = Carbon::now()->format('m');

        $izin = Izin::whereMonth('created_at', '=', $bulan)->paginate(6);
        return view('presensi.admin.rekapIzin', [
            'izin' => $izin,
            'tanggal' => $tanggal
        ]);
    }

    public function bulanIzin(Request $request)
    {
        $bulan = $request->bulan;

        if ($bulan == 01) {
            $tanggal = "Januari";
        } elseif ($bulan == 02) {
            $tanggal = "Februari";
        } elseif ($bulan == 03) {
            $tanggal = "Maret";
        } elseif ($bulan == 04) {
            $tanggal = "April";
        } elseif ($bulan == 05) {
            $tanggal = "Mei";
        } elseif ($bulan == 06) {
            $tanggal = "Juni";
        } elseif ($bulan == 07) {
            $tanggal = "Juli";
        } else {
            $tanggal = $bulan;
        }

        $izin = Izin::whereMonth('created_at', '=', $bulan)->paginate(31);

        return view('presensi.admin.rekapIzin', [
            'izin' => $izin,
            'tanggal' => $tanggal
        ]);
    }

    public function detailPresensiPegawai($id)
    {
        $id = Crypt::decrypt($id);

        $bulan = Carbon::now()->format('m');

        $pegawai = Pegawai::findOrFail($id);

        $presensi = Presensi::where('pegawai_id', $id)->whereMonth('created_at', '=', $bulan)->paginate(24);
        $hadir = Presensi::where('pegawai_id', $id)->Where('keterangan', "Hadir")->orWhere('keterangan', "Terlambat")
            ->whereMonth('created_at', '=', $bulan)->count();
        $izin = Presensi::where('pegawai_id', $id)->Where('keterangan', "Izin")
            ->whereMonth('created_at', '=', $bulan)->count();
        $sakit = Presensi::where('pegawai_id', $id)->Where('keterangan', "Sakit")
            ->whereMonth('created_at', '=', $bulan)->count();
        $alpha = Presensi::where('pegawai_id', $id)->Where('keterangan', "Alpha")
            ->whereMonth('created_at', '=', $bulan)->count();

        return view('presensi.admin.detailPresensi', [
            "hadir" => $hadir,
            "izin" => $izin,
            // "terlambat" => $terlambat,
            "sakit" => $sakit,
            "alpha" => $alpha,
            'presensi' => $presensi,
            'pegawai' => $pegawai
        ]);
    }

    public function presensiPegawaiBulan($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $bulan = $request->bulan;

        $pegawai = Pegawai::findOrFail($id);

        $presensi = Presensi::where('pegawai_id', $id)->whereMonth('created_at', '=', $bulan)->paginate(24);
        $hadir = Presensi::where('pegawai_id', $id)->Where('keterangan', "Hadir")->orWhere('keterangan', "Terlambat")
            ->whereMonth('created_at', '=', $bulan)->count();
        $izin = Presensi::where('pegawai_id', $id)->Where('keterangan', "Izin")
            ->whereMonth('created_at', '=', $bulan)->count();
        $sakit = Presensi::where('pegawai_id', $id)->Where('keterangan', "Sakit")
            ->whereMonth('created_at', '=', $bulan)->count();
        $alpha = Presensi::where('pegawai_id', $id)->Where('keterangan', "Alpha")
            ->whereMonth('created_at', '=', $bulan)->count();

        return view('presensi.admin.detailPresensi', [
            "hadir" => $hadir,
            "izin" => $izin,
            // "terlambat" => $terlambat,
            "sakit" => $sakit,
            "alpha" => $alpha,
            'presensi' => $presensi,
            'pegawai' => $pegawai
        ]);
    }

    public function alphaPegawai(Request $request, $id)
    {
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $localtime = $date->format('H:i:s');

        $validatedData = $request->validate([
            'keterangan' => 'required|max:255',
        ]);

        $pegawai = Pegawai::where('id', $id)->first();

        $validatedData['pegawai_id'] = $pegawai->id;

        $validatedData['user_id'] = $pegawai->user_id;

        $validatedData['sekolah_id'] = $pegawai->sekolah_id;

        $validatedData['tgl'] = $tanggal;

        $validatedData['jam_presensi'] = $localtime;

        $validatedData['status'] = "Alpha";

        Presensi::create($validatedData);

        return Redirect::back()->with('success', 'Presensi Berhasil');
    }
}
