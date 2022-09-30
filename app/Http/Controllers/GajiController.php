<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Gaji;
use App\Models\GajiMapel;
use App\Models\GajiPegawai;
use App\Models\GuruMapel;
use App\Models\Jabatan;
use App\Models\Pasangan;
use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\Sekolah;
use App\Models\Setting;
use App\Models\TMJabatan;
use App\Models\TMMapel;
use App\Models\TrxASN;
use App\Models\TrxGuruHonorer;
use App\Models\TrxPegawai;
use App\Models\TrxPPPK;
use App\Models\Tunjangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use PDF;

class GajiController extends Controller
{
    public function gajiPegawai()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $bulan = Carbon::now()->format('m');
        $tanggal = Carbon::now()->isoFormat('MMMM Y');

        $gaji = Gaji::where('sekolah_id', $sekolah->id)->whereMonth('created_at', '=', $bulan)->orderBy('pegawai_id', 'asc')->paginate(6);
        $notGaji =  Gaji::where('sekolah_id', $sekolah->id)->whereMonth('created_at', '=', $bulan)->pluck('pegawai_id');
        // $notJabatan =  Jabatan::where('sekolah_id', $sekolah->id)->pluck('pegawai_id');
        $pegawai = Pegawai::whereIn('id', $notGaji)->where('status', "Aktif")->pluck('id');

        $gaji = DB::table('trx_gaji')
            ->select('trx_gaji.id', 'trx_gaji.gaji_pokok', 'trx_gaji.tanggal_penggajian', 'trx_gaji.status', 'tbl_pegawai.nama_lengkap', 'tbl_pegawai.golongan_guru', 'tm_jabatan.nama_jabatan')
            ->join('tbl_pegawai', 'trx_gaji.pegawai_id', '=', 'tbl_pegawai.id')
            ->leftjoin('tbl_jabatan', 'trx_gaji.pegawai_id', '=', 'tbl_jabatan.pegawai_id')
            ->leftjoin('tm_jabatan', 'tbl_jabatan.jabatan_id', '=', 'tm_jabatan.id')
            ->whereMonth('trx_gaji.created_at', '=', $bulan)
            ->where('tbl_pegawai.status', "Aktif")
            ->orderBy('trx_gaji.pegawai_id', 'asc')->paginate(6);


        $asn = TrxASN::join('tbl_pegawai', 'trx_guru_asn.pegawai_id', '=', 'tbl_pegawai.id')
            ->select('trx_guru_asn.id', 'skh_guru_asn.gaji_asn', 'tbl_pegawai.nama_lengkap', 'tbl_pegawai.golongan_guru', 'tm_jabatan.nama_jabatan')
            ->join('skh_guru_asn', 'trx_guru_asn.skh_asn_id', '=', 'skh_guru_asn.id')
            ->leftjoin('tbl_jabatan', 'trx_guru_asn.pegawai_id', '=', 'tbl_jabatan.pegawai_id')
            ->leftjoin('tm_jabatan', 'tbl_jabatan.jabatan_id', '=', 'tm_jabatan.id')
            ->whereNotIn('trx_guru_asn.pegawai_id', $pegawai)
            ->where('trx_guru_asn.sekolah_id', $sekolah->id)
            ->where('tbl_pegawai.status', "Aktif")
            ->get();


        $pppk = DB::table('trx_guru_pppk')
            ->select('trx_guru_pppk.id', 'skh_guru_pppk.gaji_pppk', 'tbl_pegawai.nama_lengkap', 'tbl_pegawai.golongan_guru', 'tm_jabatan.nama_jabatan')
            ->join('tbl_pegawai', 'trx_guru_pppk.pegawai_id', '=', 'tbl_pegawai.id')
            ->join('skh_guru_pppk', 'trx_guru_pppk.skh_pppk_id', '=', 'skh_guru_pppk.id')
            ->leftjoin('tbl_jabatan', 'trx_guru_pppk.pegawai_id', '=', 'tbl_jabatan.pegawai_id')
            ->leftjoin('tm_jabatan', 'tbl_jabatan.jabatan_id', '=', 'tm_jabatan.id')
            ->whereNotIn('trx_guru_pppk.pegawai_id', $pegawai)
            ->where('trx_guru_pppk.sekolah_id', $sekolah->id)
            ->where('tbl_pegawai.status', "Aktif")
            ->get();

        $honorer = DB::table('trx_guru_honorer')
            ->select('trx_guru_honorer.id', 'trx_guru_honorer.gaji_pokok', 'tbl_pegawai.nama_lengkap', 'tbl_pegawai.golongan_guru', 'tm_jabatan.nama_jabatan')
            ->join('tbl_pegawai', 'trx_guru_honorer.pegawai_id', '=', 'tbl_pegawai.id')
            ->leftjoin('tbl_jabatan', 'trx_guru_honorer.pegawai_id', '=', 'tbl_jabatan.pegawai_id')
            ->leftjoin('tm_jabatan', 'tbl_jabatan.jabatan_id', '=', 'tm_jabatan.id')
            ->whereNotIn('trx_guru_honorer.pegawai_id', $pegawai)
            ->where('trx_guru_honorer.sekolah_id', $sekolah->id)
            ->where('tbl_pegawai.status', "Aktif")
            ->get();

        $ps = DB::table('trx_pegawai')
            ->select('trx_pegawai.id', 'trx_pegawai.gaji_pokok', 'tbl_pegawai.nama_lengkap', 'tbl_pegawai.golongan_guru', 'tm_jabatan.nama_jabatan')
            ->join('tbl_pegawai', 'trx_pegawai.pegawai_id', '=', 'tbl_pegawai.id')
            ->leftjoin('tbl_jabatan', 'trx_pegawai.pegawai_id', '=', 'tbl_jabatan.pegawai_id')
            ->leftjoin('tm_jabatan', 'tbl_jabatan.jabatan_id', '=', 'tm_jabatan.id')
            ->whereNotIn('trx_pegawai.pegawai_id', $pegawai)
            ->where('trx_pegawai.sekolah_id', $sekolah->id)
            ->where('tbl_pegawai.status', "Aktif")
            ->get();

        // dd($asn);

        return view('gaji.index', [
            'gaji' => $gaji,
            'tanggal' => $tanggal,
            'asn' => $asn,
            'pppk' => $pppk,
            'honorer' => $honorer,
            'ps' => $ps,
            'pegawai' => $pegawai
        ]);
    }

    public function rekapGajiPegawai()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $gaji = Gaji::where('sekolah_id', $sekolah->id)->orderBy('created_at', 'desc')->paginate(5);

        return view('gaji.rekap', [
            'gaji' => $gaji,
        ]);
    }

    public function bulanGajiPegawai(Request $request)
    {
        $bulan = $request->bulan;

        $gaji = Gaji::whereMonth('created_at', '=', $bulan)->orderBy('created_at', 'desc')->paginate(5);

        return view('gaji.rekap', [
            'gaji' => $gaji,
        ]);
    }


    public function tambahGajiPegawai(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'tanggal_penggajian' => 'required',
            'pegawai_id' => 'required',
        ]);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $jabatan = Jabatan::Where('pegawai_id', $request->pegawai_id)->first();

        $tmJabatan = TMJabatan::Where('id', $jabatan->jabatan_id)->first();

        $bulan = Carbon::now()->format('m');

        $pegawai = Pegawai::where('id', $request->pegawai_id)->first();


        $validatedData['sekolah_id'] = $sekolah->id;
        $validatedData['user_id'] = $pegawai->user_id;
        $validatedData['jabatan_id'] = $jabatan->jabatan_id;
        $validatedData['gaji_pokok'] = $tmJabatan->gaji_pokok;
        $validatedData['status'] = "Belum Dibayar";
        $validatedData['bulan'] = $bulan;

        GajiPegawai::create($validatedData);

        return redirect('/gajiPegawai')->with('success', 'Gaji Berhasil di Tambah');
    }

    public function detailGajiPegawai($id, Gaji $gaji)
    {
        $id = Crypt::decrypt($id);
        $gaji = Gaji::findOrFail($id);

        $data = Gaji::where('id', $id)->get()->first();

        $bulan = $data->created_at->format('M');

        $j = Jabatan::where('pegawai_id', $data->pegawai_id)->first();

        $jabatan = TMJabatan::where('id', $j->jabatan_id)->first();

        $setting = Setting::where('sekolah_id', $data->sekolah_id)->get();
        $tunjangan = Tunjangan::where('sekolah_id', $data->sekolah_id)->first();

        $pasangan = Pasangan::where('pegawai_id', $data->pegawai_id)->count();
        $anak = Anak::where('pegawai_id', $data->pegawai_id)->count();

        $absensi = Presensi::where('pegawai_id', $data->pegawai_id)->count();
        $hadir = Presensi::where('pegawai_id', $data->pegawai_id)->where('keterangan', "Hadir")
            ->whereMonth('created_at', '=', $bulan)->count();
        $terlambat = Presensi::where('pegawai_id', $data->pegawai_id)->where('keterangan', "Terlambat")
            ->whereMonth('created_at', '=', $bulan)->count();
        $ijin = Presensi::where('pegawai_id', $data->pegawai_id)->where('keterangan', "Ijin")
            ->whereMonth('created_at', '=', $bulan)->count();
        $sakit = Presensi::where('pegawai_id', $data->pegawai_id)->where('keterangan', "Sakit")
            ->whereMonth('created_at', '=', $bulan)->count();
        $alpha = Presensi::where('pegawai_id', $data->pegawai_id)->where('keterangan', "Alpha")
            ->whereMonth('created_at', '=', $bulan)->count();

        $totalHadir = $hadir + $terlambat;

        return view('gaji.slip', [
            'gaji' => $gaji,
            'absensi' => $absensi,
            'hadir' => $totalHadir,
            'ijin' => $ijin,
            'sakit' => $sakit,
            'alpha' => $alpha,
            'setting' => $setting,
            'pasangan' => $pasangan,
            'anak' => $anak,
            'tunjangan' => $tunjangan,
            'nama_jabatan' => $jabatan->nama_jabatan,
            'data' => $data
        ]);
    }

    public function slipPegawai($id, GajiPegawai $gaji)
    {
        $id = Crypt::decrypt($id);
        $gaji = Gaji::findOrFail($id);

        $data = Gaji::where('id', $id)->get()->first();

        $bulan = $data->created_at->format('M');

        $j = Jabatan::where('pegawai_id', $data->pegawai_id)->first();

        $jabatan = TMJabatan::where('id', $j->jabatan_id)->first();

        $setting = Setting::where('sekolah_id', $data->sekolah_id)->get();
        $tunjangan = Tunjangan::where('sekolah_id', $data->sekolah_id)->first();

        $pasangan = Pasangan::where('pegawai_id', $data->pegawai_id)->count();
        $anak = Anak::where('pegawai_id', $data->pegawai_id)->count();

        $absensi = Presensi::where('pegawai_id', $data->pegawai_id)->count();
        $hadir = Presensi::where('pegawai_id', $data->pegawai_id)->where('keterangan', "Hadir")
            ->whereMonth('created_at', '=', $bulan)->count();
        $terlambat = Presensi::where('pegawai_id', $data->pegawai_id)->where('keterangan', "Terlambat")
            ->whereMonth('created_at', '=', $bulan)->count();
        $ijin = Presensi::where('pegawai_id', $data->pegawai_id)->where('keterangan', "Ijin")
            ->whereMonth('created_at', '=', $bulan)->count();
        $sakit = Presensi::where('pegawai_id', $data->pegawai_id)->where('keterangan', "Sakit")
            ->whereMonth('created_at', '=', $bulan)->count();
        $alpha = Presensi::where('pegawai_id', $data->pegawai_id)->where('keterangan', "Alpha")
            ->whereMonth('created_at', '=', $bulan)->count();

        $totalHadir = $hadir + $terlambat;

        return view('gaji.slipPegawai', [
            'gaji' => $gaji,
            'absensi' => $absensi,
            'hadir' => $totalHadir,
            'ijin' => $ijin,
            'sakit' => $sakit,
            'alpha' => $alpha,
            'setting' => $setting,
            'pasangan' => $pasangan,
            'anak' => $anak,
            'tunjangan' => $tunjangan,
            'nama_jabatan' => $jabatan->nama_jabatan
        ]);
    }

    public function downloadGajiPegawai($id, GajiPegawai $gaji)
    {
        $id = Crypt::decrypt($id);
        $gaji = Gaji::findOrFail($id);

        $getPegawai = Gaji::where('id', $id)->first();

        $bulan = $getPegawai->created_at->format('M');

        $j = Jabatan::where('pegawai_id', $getPegawai->pegawai_id)->first();

        $jabatan = TMJabatan::where('id', $j->jabatan_id)->first();

        $pegawai = Pegawai::where('id', $getPegawai->pegawai_id)->first();

        $setting = Setting::where('sekolah_id', $getPegawai->sekolah_id)->get();
        $tunjangan = Tunjangan::where('sekolah_id', $getPegawai->sekolah_id)->first();

        $pasangan = Pasangan::where('pegawai_id', $getPegawai->pegawai_id)->count();
        $anak = Anak::where('pegawai_id', $getPegawai->pegawai_id)->count();

        $absensi = Presensi::where('pegawai_id', $getPegawai->pegawai_id)->count();
        $hadir = Presensi::where('pegawai_id', $getPegawai->pegawai_id)->where('keterangan', "Hadir")
            ->whereMonth('created_at', '=', $bulan)->count();
        $terlambat = Presensi::where('pegawai_id', $getPegawai->pegawai_id)->where('keterangan', "Terlambat")
            ->whereMonth('created_at', '=', $bulan)->count();
        $ijin = Presensi::where('pegawai_id', $getPegawai->pegawai_id)->where('keterangan', "Ijin")
            ->whereMonth('created_at', '=', $bulan)->count();
        $sakit = Presensi::where('pegawai_id', $getPegawai->pegawai_id)->where('keterangan', "Sakit")
            ->whereMonth('created_at', '=', $bulan)->count();
        $alpha = Presensi::where('pegawai_id', $getPegawai->pegawai_id)->where('keterangan', "Alpha")
            ->whereMonth('created_at', '=', $bulan)->count();

        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $totalHadir = $hadir + $terlambat;

        $pdf = PDF::loadview('gaji.pdf', [
            'gaji' => $gaji,
            'absensi' => $absensi,
            'hadir' => $totalHadir,
            'ijin' => $ijin,
            'sakit' => $sakit,
            'alpha' => $alpha,
            'setting' => $setting,
            'tanggal' => $tanggal,
            'pasangan' => $pasangan,
            'anak' => $anak,
            'tunjangan' => $tunjangan,
            'jabatan' => $jabatan
        ]);

        return $pdf->download('Gaji' . '_' . $pegawai->nama_lengkap . '_' . $tanggal .  '.pdf');

        // return view('gaji.pdf', [
        //     'gaji' => $gaji,
        //     'absensi' => $absensi,
        //     'hadir' => $totalHadir,
        //     'ijin' => $ijin,
        //     'sakit' => $sakit,
        //     'alpha' => $alpha,
        //     'setting' => $setting,
        //     'tanggal' => $tanggal,
        //     'pasangan' => $pasangan,
        //     'anak' => $anak,
        //     'tunjangan' => $tunjangan,
        //     'jabatan' => $jabatan
        // ]);
    }

    public function bayarGajiPegawai($id, Gaji $gaji)
    {
        $id = Crypt::decrypt($id);
        $gaji = Gaji::findOrFail($id);

        $pegawai = Gaji::where('id', $id)->first();

        $tunjangan = Tunjangan::where('sekolah_id', $pegawai->sekolah_id)->first();

        $j = Jabatan::where('pegawai_id', $pegawai->pegawai_id)->first();

        $jabatan = TMJabatan::where('id', $j->jabatan_id)->first();

        $pasangan = Pasangan::where('pegawai_id', $pegawai->pegawai_id)->count();
        $anak = Anak::where('pegawai_id', $pegawai->pegawai_id)->count();

        $absensi = Presensi::where('pegawai_id', $pegawai->pegawai_id)->count();
        $hadir = Presensi::where('pegawai_id', $pegawai->pegawai_id)->where('keterangan', "Hadir")
            ->whereMonth('created_at', '=', $pegawai->bulan)->count();
        $terlambat = Presensi::where('pegawai_id', $pegawai->pegawai_id)->where('keterangan', "Terlambat")
            ->whereMonth('created_at', '=', $pegawai->bulan)->count();
        $ijin = Presensi::where('pegawai_id', $pegawai->pegawai_id)->where('keterangan', "Ijin")
            ->whereMonth('created_at', '=', $pegawai->bulan)->count();
        $sakit = Presensi::where('pegawai_id', $pegawai->pegawai_id)->where('keterangan', "Sakit")
            ->whereMonth('created_at', '=', $pegawai->bulan)->count();
        $alpha = Presensi::where('pegawai_id', $pegawai->pegawai_id)->where('keterangan', "Alpha")
            ->whereMonth('created_at', '=', $pegawai->bulan)->count();

        $totalHadir = $hadir + $terlambat;

        return view('gaji.bayar', [
            'gaji' => $gaji,
            'hadir' => $totalHadir,
            'tunjangan' => $tunjangan,
            'pasangan' => $pasangan,
            'anak' => $anak,
            'jabatan' => $jabatan
        ]);
    }

    public function bayarPegawai($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'bukti_pembayaran' => 'required',
        ];

        if ($request->file('bukti_pembayaran')) {

            $file = $request->file('bukti_pembayaran');

            $bukti_pembayaran = $file->getClientOriginalName();

            $file->move('Pembayaran Gaji', $file->getClientOriginalName());
        }

        $validatedData['bukti_pembayaran'] = $bukti_pembayaran;
        $validatedData['total_gaji'] = $request->total_gaji;
        $validatedData['tunjangan_pasangan'] = $request->tunjangan_pasangan;
        $validatedData['tunjangan_anak'] = $request->tunjangan_anak;
        $validatedData['tunjangan_pangan'] = $request->tunjangan_pangan;
        $validatedData['status'] = "Dibayar";

        Gaji::where('id', $id)
            ->update($validatedData);

        return redirect('/gajiPegawai')->with('success', 'Gaji Berhasil di Bayar');
    }

    public function gajiUserPegawai()
    {
        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        $gaji = Gaji::where('pegawai_id', $pegawai->id)->get();

        return view('gaji.pegawai', [
            'gaji' => $gaji,
        ]);
    }

    public function hapusGajiPegawai($id)
    {
        $id = Crypt::decrypt($id);
        Gaji::destroy($id);

        return redirect('/gajiPegawai')->with('success', 'Gaji Pegawai Berhasil di Hapus');
    }

    public function riwayatGaji()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->first();

        $riwayat = Gaji::select("*", DB::raw("count(*) as total"))->where('sekolah_id', $sekolah->id)->groupBy('pegawai_id')->paginate(6);

        $not = Gaji::where('sekolah_id', $sekolah->id)->groupBy('pegawai_id')->pluck('pegawai_id');

        $pegawai = Pegawai::where('sekolah_id', $sekolah->id)->whereNotIn('id', $not)->get();

        // dd($riwayat);

        return view('gaji.riwayat', [
            'riwayat' => $riwayat,
            'pegawai' => $pegawai
        ]);
    }

    public function detailRiwayatGaji($id)
    {
        $id = Crypt::decrypt($id);

        $get = Gaji::findOrFail($id);

        $gaji = Gaji::where('pegawai_id', $get->pegawai_id)->paginate(6);

        // dd($gaji);

        return view('gaji.detailRiwayat', [
            'gaji' => $gaji,
        ]);
    }
}
