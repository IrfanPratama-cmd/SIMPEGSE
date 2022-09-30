<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        $kelas = Kelas::where('sekolah_id', $sekolah_id)->get();

        $angkatan = Angkatan::where('sekolah_id', $sekolah_id)->get();

        $tahun = date_create()->format('Y');

        return view('siswa.index', [
            'siswa' => Siswa::where('sekolah_id', $sekolah_id)->orderBy('nama_Siswa', 'asc')->paginate(6),
            'nama_sekolah' => $nama_sekolah,
            'kelas' => $kelas,
            'angkatan' => $angkatan,
            'tanggal' => $tahun
        ]);
    }

    public function tambahSiswa(Request $request)
    {
        // dd($request);

        // $validatedData2 = $request->validate([
        //     'angkatan' => 'required',
        // ]);

        $data = $request->all();
        $createUser = $this->create($data);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];

        // $validatedData['sekolah_id'] = $sekolah_id;
        // $validatedData['role'] = "Siswa";
        $validatedData2['sekolah_id'] = $sekolah_id;
        $validatedData2['angkatan_id'] = $request->angkatan_id;
        $validatedData2['nama_siswa'] = $createUser->name;
        $validatedData2['status'] = "Aktif";
        $validatedData2['user_id'] = $createUser->id;
        $validatedData['is_email_verified'] = "1";

        $token = Str::random(64);

        // User::create($validatedData);
        Siswa::create($validatedData2);
        // dd($validatedData);

        $submit = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        if (!$submit) {
            return Redirect::back()->with('success', 'Presensi Berhasil');
        } else {
            Mail::send('email.inputPassword', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Verify Email & Input Password');
            });
        }

        return redirect("/dataSiswa")->with('success', 'Tambah User Berhasil!');
    }

    public function create(array $data)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'sekolah_id' => $sekolah_id,
            'role' => "Siswa"
        ]);
    }

    public function editSiswa($id)
    {
        $id = Crypt::decrypt($id);

        $siswa = Siswa::findOrFail($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $angkatan = Angkatan::where('sekolah_id', $sekolah->id)->get();

        return view('siswa.edit', [
            'siswa' => $siswa,
            'angkatan' => $angkatan
        ]);
    }

    public function updateDataSiswa($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $rules = [
            'angkatan_id' => 'required',
            'nama_siswa' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['tahun_lulus'] = $request->tahun_lulus;

        Siswa::where('id', $id)->update($validatedData);

        return redirect("/dataSiswa")->with('success', 'Data Siswa Berhasil Di Update!');
    }

    public function profileSiswa()
    {
        return view('profiles.siswa', [
            'siswa' => Siswa::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function editProfileSiswa($id)
    {
        $id = Crypt::decrypt($id);

        $siswa = Siswa::findOrFail($id);

        return view('profiles.form.editSiswa', [
            'siswa' => $siswa
        ]);
    }

    public function updateProfileSiswa($id, Request $request)
    {
        // dd($request);

        $id = Crypt::decrypt($id);

        $rules = [
            'nama_siswa' => 'required|max:255',
            'nis' => 'required',
            'no_telp' => 'required|max:255',
            'agama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required'
        ];

        $data = $request->all();

        $folder = "profile-siswa";

        $siswa = Siswa::where('user_id', auth()->user()->id)->first();

        $validatedData = $request->validate($rules);

        if ($request->file('foto_profile')) {
            // if ($request->oldImage) {
            //     Storage::delete($request->oldImage);
            // }
            // $validatedData['foto_profile'] = $request->file('foto_profile')->store('foto-profile-siswa');

            $file = $request->file('foto_profile');

            $extension = $request->file('foto_profile')->getClientOriginalExtension();

            $nama = $siswa->nama_siswa  . '_' .  $folder . '.' . $extension;

            $file->move($folder, $nama);

            $validatedData['foto_profile'] = $nama;
        }

        Siswa::where('id', $id)
            ->update($validatedData);

        return redirect('/profileSiswa')->with('success', 'Profile Siswa Berhasil di Update');
    }

    public function detailSiswa($id)
    {
        $id = Crypt::decrypt($id);

        $siswa = Siswa::findOrFail($id);

        return view('siswa.detail', [
            'siswa' => $siswa
        ]);
    }

    public function cariSiswa(Request $request)
    {
        if ($request->cariSiswa) {
            $cari = $request->cariSiswa;

            $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

            $tahun = date_create()->format('Y');

            $siswa = Siswa::where('nama_siswa', 'like', '%' . $cari . '%')
                ->where('sekolah_id', $sekolah->id)->paginate(6);

            $angkatan = Angkatan::where('sekolah_id', $sekolah->id)->get();

            return view('siswa.index', [
                'siswa' => $siswa,
                'nama_sekolah' => $sekolah->nama_sekolah,
                'angkatan' => $angkatan,
                'tanggal' => $tahun
            ]);
        } elseif ($request->filter) {
            $cari = $request->filter;

            $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

            $siswa = Siswa::where('angkatan_id', 'like', '%' . $cari . '%')
                ->where('sekolah_id', $sekolah->id)->paginate(6);

            $tahun = date_create()->format('Y');

            $angkatan = Angkatan::where('sekolah_id', $sekolah->id)->get();

            return view('siswa.index', [
                'siswa' => $siswa,
                'nama_sekolah' => $sekolah->nama_sekolah,
                'angkatan' => $angkatan,
                'tanggal' => $tahun
            ]);
        }
    }

    public function angkatan()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->first();

        // $count = Siswa::where('sekolah_id', $sekolah->id)->groupBy('angkatan_id')->count();

        // $count = DB::table('tbl_siswa')
        //     ->join('tbl_angkatan', 'tbl_siswa.angkatan_id', '=', 'tbl_angkatan.id')
        //     ->select(DB::raw('count(*) as total'))->groupBy('angkatan_id')->get();

        $count = Siswa::select("*", DB::raw("count(*) as total"))->where('sekolah_id', $sekolah->id)->groupBy('angkatan_id')->get();

        $notSiswa = Siswa::where('sekolah_id', $sekolah->id)->groupBy('angkatan_id')->pluck('angkatan_id');

        $angkatan =  Angkatan::where('sekolah_id', $sekolah->id)->whereNotIn('id', $notSiswa)->get();

        // dd($notSiswa);

        return view('angkatan.index', [
            'angkatan' => $angkatan,
            'nama_sekolah' => $sekolah->nama_sekolah,
            'count' => $count
        ]);
    }

    public function tambahAngkatan(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->first();

        $validatedData = $request->validate([
            'angkatan' => 'required|max:255',
        ]);

        $validatedData['sekolah_id'] = $sekolah->id;

        Angkatan::create($validatedData);

        return redirect('/angkatan')->with('success', 'Kelas Berhasil di Tambah');
    }
}
