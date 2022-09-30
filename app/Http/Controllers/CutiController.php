<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Sekolah;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use PDF;
use DateTime;
use DateTimeZone;
use Response;
use Carbon\Carbon;

class CutiController extends Controller
{
    public function cuti()
    {
        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        $cuti = Cuti::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);

        $setting = Setting::where('sekolah_id', $pegawai->sekolah_id)->sum('cuti');

        $jml = Cuti::where('pegawai_id', $pegawai->id)->where('status', "Disetujui")->where('jenis_cuti', "Cuti Tahunan")->sum('brp_hari');

        $total = $setting - $jml;

        // dd($total);

        return view('cuti.index', [
            'cuti' => $cuti,
            'total' => $total,
            'jml' => $jml,
            'setting' => $setting
        ]);
    }

    public function tambahCuti()
    {
        return view('cuti.tambah');
    }

    public function simpanCuti(Request $request)
    {
        $validatedData = $request->validate([
            'brp_hari' => 'required',
            'jenis_cuti' => 'required',
            'alasan' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required'
        ]);

        $getPegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$getPegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];
        $sekolah_id = $get2['sekolah_id'];


        $file = $request->file('bukti_cuti');

        $bukti = $file->getClientOriginalName();

        $file->move('cuti', $file->getClientOriginalName());

        $validatedData['bukti_cuti'] = $bukti;

        $validatedData['status'] = "Menunggu";
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['pegawai_id'] = $pegawai_id;
        $validatedData['sekolah_id'] = $sekolah_id;

        Cuti::create($validatedData);

        return redirect('/cutiPegawai')->with('success', 'Berhasil mengajukan cuti, Silahkan menunggu untuk di validasi');
    }

    public function editCuti($id, Cuti $cuti)
    {
        $id = Crypt::decrypt($id);
        $cuti = Cuti::findOrFail($id);

        return view('cuti.edit', [
            'cuti' => $cuti
        ]);
    }

    public function updateCuti($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'brp_hari' => 'required',
            'jenis_cuti' => 'required',
            'alasan' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required'
        ];

        $validatedData = $request->validate($rules);

        Cuti::where('id', $id)->update($validatedData);

        return redirect('/cutiPegawai')->with('success', 'Berhasil mengajukan cuti, Silahkan menunggu untuk di validasi');
    }

    public function hapusCuti($id)
    {
        $id = Crypt::decrypt($id);

        Cuti::destroy($id);

        return redirect('/cutiPegawai')->with('success', 'Berhasil Menghapus Cuti');
    }

    public function dataCuti()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];

        $cuti = Cuti::where('sekolah_id', $sekolah_id)->orderBy('created_at', 'desc')->paginate(6);

        return view('cuti.admin.index', [
            'cuti' => $cuti
        ]);
    }

    public function terimaCuti($id, Request $request)
    {
        $rules = [
            'status' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Cuti::where('id', $id)->update($validatedData);

        return Redirect::back()->with('success', 'Cuti Diterima');
    }

    public function tolakCuti($id, Request $request)
    {
        $rules = [
            'status' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Cuti::where('id', $id)->update($validatedData);

        return Redirect::back()->with('success', 'Cuti Ditolak');
    }

    public function downloadSurat($id, Cuti $cuti)
    {
        $id = Crypt::decrypt($id);
        $cuti = Cuti::findOrFail($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];

        $getPegawai = Cuti::where('id', $id)->get()->toArray();
        $objectToArray = (array)$getPegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['pegawai_id'];

        $getNama = Pegawai::where('id', $pegawai_id)->get()->toArray();
        $objectToArray = (array)$getNama;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $nama_lengkap = $get2['nama_lengkap'];

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');

        $jabatan = Jabatan::where('pegawai_id', $pegawai_id)->get();

        $setting = Setting::where('sekolah_id', $sekolah_id)->get();

        $pdf = PDF::loadview('cuti.surat', [
            'cuti' =>  $cuti,
            'setting' => $setting,
            'tanggal' => $tanggal,
            // 'jabatan' => $jabatan,
        ]);

        // return view('cuti.surat', [
        //     'cuti' =>  $cuti,
        //     'setting' => $setting,
        //     'tanggal' => $tanggal,
        // ]);

        return $pdf->download('Surat Cuti ' . $nama_lengkap . '.pdf');
    }

    public function downloadSuratpegawai($id)
    {
        $id = Crypt::decrypt($id);
        $cuti = Cuti::findOrFail($id);

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        $namaPegawai = $pegawai->nama_lengkap;

        $setting = Setting::where('sekolah_id', $pegawai->sekolah_id)->get();

        $pdf = PDF::loadview('cuti.surat', [
            'cuti' =>  $cuti,
            'setting' => $setting,
            'tanggal' => $tanggal,
            // 'jabatan' => $jabatan,
        ]);

        return $pdf->download('Surat Cuti ' . $namaPegawai . '.pdf');
    }

    public function downloadBuktiCuti($bukti_cuti)
    {
        $filepath = public_path('cuti' . '/' . $bukti_cuti);
        return Response::download($filepath);
    }
}
