<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Organisasi;
use App\Models\Ortu;
use App\Models\Pasangan;
use App\Models\Pegawai;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DataDiriController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::where('user_id', auth()->user()->id)->count();
        $pendidikan = Pendidikan::where('user_id', auth()->user()->id)->count();
        $organisasi = Organisasi::where('user_id', auth()->user()->id)->count();
        $ortu = Ortu::where('user_id', auth()->user()->id)->count();
        $pasangan = Pasangan::where('user_id', auth()->user()->id)->count();
        $anak = Anak::where('user_id', auth()->user()->id)->count();

        return view('dashboard.data-diri', [
            'pegawai' => $pegawai,
            'pendidikan' => $pendidikan,
            'organisasi' => $organisasi,
            'ortu' => $ortu,
            'pasangan' => $pasangan,
            'anak' => $anak
        ]);
    }

    public function profilePegawai()
    {
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
            ->where('tbl_pegawai.user_id', auth()->user()->id)
            ->get();
        // ->pluck('tbl_pegawai.id');

        // dd($pegawai);

        $id = Pegawai::where('user_id', auth()->user()->id)->pluck('id');

        $foto = Pegawai::where('user_id', auth()->user()->id)->pluck('foto_profile');

        $ktp = Pegawai::where('user_id', auth()->user()->id)->pluck('foto_ktp');

        $masuk = Pegawai::where('user_id', auth()->user()->id)->pluck('created_at');

        $tanggal = date_create();

        return view('profiles.pegawai', [
            'pegawai' => $pegawai,
            'id' => $id,
            'foto' => $foto,
            'masuk' => $masuk,
            'tanggal' => $tanggal,
            'ktp' => $ktp
        ]);
    }

    public function infoUtama($id, Pegawai $pegawai)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);

        return view('profiles.form.infoUtama', [
            'pegawai' => $pegawai
        ]);
    }

    public function updateInfoUtama($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        $rules = [
            'nama_lengkap' => 'required|max:255',
            'nip' => 'required',
            'no_telp' => 'required|max:255',
        ];

        $validatedData = $request->validate($rules);

        $folder = "foto-profile";

        if ($request->file('foto_profile')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            // $validatedData['foto_profile'] = $request->file('foto_profile')->store('foto-profile');

            // $request->file('foto_profile')->store('foto-profile');

            $file = $request->file('foto_profile');

            $extension = $request->file('foto_profile')->getClientOriginalExtension();

            $nama = $pegawai->nama_lengkap  . '_' .  $folder . '.' . $extension;

            $file->move($folder, $nama);

            $validatedData['foto_profile'] = $nama;
        }

        Pegawai::where('id', $id)
            ->update($validatedData);

        return redirect('/profilePegawai')->with('success', 'Profile User Berhasil di Update');
    }

    public function dataPendukung($id, Pegawai $pegawai)
    {
        $id = Crypt::decrypt($id);
        $pegawai = Pegawai::findOrFail($id);

        return view('profiles.form.dataPendukung', [
            'pegawai' => $pegawai
        ]);
    }

    public function updateDataPendukung($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nik' => 'required|max:255',
            'no_kk' => 'required',
            'agama' => 'required|max:255',
            'no_npwp' => 'required|max:255',
            'no_bpjs' => 'required',
            'no_rekening' => 'required',
            'jk' => 'required|max:255',
            'alamat' => 'required|max:255',
        ];

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        $folder = "foto-ktp";

        $validatedData = $request->validate($rules);

        if ($request->file('foto_ktp')) {
            // if ($request->oldImage) {
            //     Storage::delete($request->oldImage);
            // }
            // $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('foto-ktp');

            $file = $request->file('foto_ktp');

            $extension = $request->file('foto_ktp')->getClientOriginalExtension();

            $nama = $pegawai->nama_lengkap  . '_' .  $folder . '.' . $extension;

            $file->move($folder, $nama);

            $validatedData['foto_ktp'] = $nama;
        }

        Pegawai::where('id', $id)
            ->update($validatedData);

        return redirect('/profilePegawai')->with('success', 'Profile User Berhasil di Update');
    }
}
