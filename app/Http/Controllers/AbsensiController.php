<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Absensi;
use App\Models\Pegawai;
use App\Models\TmAbsensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = User::where('role', 'Pegawai')->pluck('id');

        return view('absensi.data-absensi', [
            'absensi' => TmAbsensi::all(),
            'pegawai' => Pegawai::pluck('id'),
            'user' => $user
        ]);
    }

    public function buatAbsen(Request $request)
    {

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');
        $localtime = $date->format('H:i:s');

        // $validatedData = $request->validate([
        //     'hari' => 'required|max:255',
        //     'jam_mulai' => 'required',
        //     'jam_akhir' => 'required',
        // ]);

        $data = $request->all();
        $createAbsen = $this->create($data);

        if (count($request->user_id) >= 0) {
            foreach ($data['user_id'] as $item => $value) {
                $data2 = array(
                    'absensi_id' => $createAbsen->id,
                    'user_id' => $data['user_id'][$item],
                    'pegawai_id' => $data['pegawai_id'][$item],
                    'keterangan' => "Belum Absen"
                );
                Absensi::create($data2);
                // dd($data2);
            }
        }

        // $validatedData['tanggal'] = $tanggal;

        // TmAbsensi::create($validatedData);

        return redirect('/data-absensi')->with('success', 'Absen Berhasil di Tambah');
    }

    public function create(array $data)
    {
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');
        $localtime = $date->format('H:i:s');

        return TmAbsensi::create([
            'hari' => $data['hari'],
            'jam_mulai' => $data['jam_mulai'],
            'jam_akhir' => $data['jam_akhir'],
            'tanggal' => $tanggal
        ]);
    }

    public function hapusAbsen($id)
    {
        $id = Crypt::decrypt($id);
        TmAbsensi::destroy($id);

        return redirect('/data-absensi')->with('success', 'Absensi Berhasil di Hapus');
    }

    public function absensiPegawai()
    {
        $getID = Pegawai::get()->toArray();
        $objectToArray = (array)$getID;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];

        // $getID = TmAbsensi::all()->toArray();
        // $objectToArray = (array)$getID;
        // $get1 = $objectToArray[0];
        // $get2 = (array)$get1;
        // $absensi_id = $get2['id'];


        $cekAbsen = Absensi::where('user_id', auth()->user()->id)->get();


        return view('absensi.absensi-pegawai', [
            'absensi' => Absensi::where('user_id', auth()->user()->id)->get(),
            'hadir' => Absensi::where('keterangan', 'Hadir')->get(),
            'cekAbsen' => $cekAbsen,
        ]);
    }

    public function absenPegawai($id, Absensi $absensi)
    {
        $id = Crypt::decrypt($id);
        $absensi = Absensi::findOrFail($id);

        $getID = Absensi::get()->toArray();
        $objectToArray = (array)$getID;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $absensi_id = $get2['id'];

        $cekAbsen = Absensi::where('absensi_id', $id)->where('user_id', auth()->user()->id)->count();
        // $absen = TMAbsensi::where('id', $absensi_id)->get();

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');
        $localtime = $date->format('H:i:s');

        return view('absensi.absenPegawai', [
            // 'absen' => $absen,
            'cekAbsen' => $cekAbsen,
            'absensi' => $absensi,
            'tanggal' => $tanggal,
            'localtime' => $localtime,
            "active" => "absen"
        ]);
    }

    public function simpanAbsen($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $getID = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$getID;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');
        $localtime = $date->format('H:i:s');


        $validatedData = $request->validate([
            'keterangan' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['pegawai_id'] = $pegawai_id;
        $validatedData['jam_absen'] = $localtime;
        $validatedData['alasan'] = $request->alasan;

        Absensi::where('id', $id)
            ->update($validatedData);

        return redirect('/absensi-pegawai')->with('success', 'Absen Berhasil');
    }

    public function rekapAbsen($id)
    {
        $id = Crypt::decrypt($id);
        $absen = Absensi::where('absensi_id', $id)->get();
        $absensi = TmAbsensi::findOrFail($id);

        return view('absensi.rekap', [
            'absen' => $absen,
            'absensi' => $absensi
        ]);
    }

    public function detailAbsen($id, Absensi $absensi)
    {
        $id = Crypt::decrypt($id);
        $absensi = Absensi::findOrFail($id);

        return view('absensi.detailAbsen', [
            'absensi' => $absensi
        ]);
    }

    public function rekapAbsenPegawai()
    {
        $absensi = Absensi::where('user_id', auth()->user()->id)->count();
        $hadir = Absensi::where('user_id', auth()->user()->id)->where('keterangan', "Hadir")->count();
        $ijin = Absensi::where('user_id', auth()->user()->id)->where('keterangan', "Ijin")->count();
        $sakit = Absensi::where('user_id', auth()->user()->id)->where('keterangan', "Sakit")->count();
        $alpha = Absensi::where('user_id', auth()->user()->id)->where('keterangan', "Alpha")->count();


        return view('absensi.rekap-absenPegawai', [
            "active" => "rekap",
            "absensi" => $absensi,
            "hadir" => $hadir,
            "ijin" => $ijin,
            "sakit" => $sakit,
            "alpha" => $alpha
        ]);
    }
}
