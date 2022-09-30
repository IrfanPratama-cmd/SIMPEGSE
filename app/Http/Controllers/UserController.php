<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pegawai;
use App\Models\Pengguna;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        return view('daftar-user.index', [
            'users' => User::Where('sekolah_id', $sekolah_id)->orderBy('created_at', 'desc')->paginate(6),
            'nama_sekolah' => $nama_sekolah
        ]);
    }

    public function verifUser(Request $request, $id)
    {
        $rules = [
            'is_email_verified' => 'required',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['email_verified_at'] = Carbon::now();

        User::where('id', $id)->update($validatedData);

        return redirect('/daftar-user')->with('success', 'User Berhasil Di Verifikasi');
    }

    public function hapusVerif(Request $request, $id)
    {
        $rules = [
            'is_email_verified' => 'required',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['email_verified_at'] = NULL;

        User::where('id', $id)->update($validatedData);

        return redirect('/daftar-user')->with('success', 'Verifikasi User Berhasil Di Hapus');
    }


    public function profileAdmin()
    {
        return view('profiles.admin', [
            'user' => User::where('id', auth()->user()->id)->get()
        ]);
    }

    // public function editAdmin(Request $request)
    // {
    //     $data = Instansi::findOrFail($request->get('id'));
    //     echo json_encode($data);
    // }

    public function editAdmin(User $user, $id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);

        // dd($instansi);

        return view('profiles.form.admin', [
            'user' => $user
        ]);
    }

    public function updateAdmin($id, Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'alamat' => 'required',
            'no_telp' => 'required|max:255',
        ];

        $update = ['name' => 'required|max:255'];
        // $username = $request->validate($update);

        $validatedData = $request->validate($rules);

        if ($request->file('foto_profile')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['foto_profile'] = $request->file('foto_profile')->store('foto-profile');
        }

        User::where('id', $id)
            ->update($validatedData);

        // User::where('id',);

        return redirect('/profileAdmin')->with('success', 'Profile Instansi Berhasil di Update');
    }

    public function profilePegawai()
    {
        return view('profiles.user', [
            'user' => User::where('id', auth()->user()->id)->get()
        ]);
    }

    public function editPegawai(User $user, $id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);

        return view('profiles.form.pegawai', [
            'user' => $user
        ]);
    }


    public function updatePegawai($id, Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'alamat' => 'required',
            'no_telp' => 'required|max:255',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('foto_profile')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['foto_profile'] = $request->file('foto_profile')->store('foto-profile');
        }

        User::where('id', $id)
            ->update($validatedData);

        return redirect('/profilePegawai')->with('success', 'Profile User Berhasil di Update');
    }

    public function cariUser(Request $request)
    {
        $cari = $request->cariUser;

        $users = User::where('name', 'like', "%" . $cari . "%")->paginate();

        return view('daftar-user.index', ['users' => $users]);
    }

    public function tambahUser()
    {
        return view('daftar-user.create');
    }

    public function tambahData(Request $request)
    {
        // dd($request);

        // $validatedData = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|unique:users',
        //     'role' => 'required',
        // ]);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];

        $data = $request->all();
        $createUser = $this->create($data);

        // $validatedData['sekolah_id'] = $sekolah_id;
        $validatedData2['sekolah_id'] = $sekolah_id;
        $validatedData2['user_id'] = $createUser->id;
        $validatedData2['nama_lengkap'] = $createUser->name;
        $validatedData2['created_at'] = $request->created_at;
        $validatedData2['golongan_guru'] = $request->golongan_guru;
        $validatedData2['status'] = "Aktif";
        // $validatedData['is_email_verified'] = "1";

        $token = Str::random(64);

        // User::create($validatedData);
        Pegawai::create($validatedData2);
        // dd($validatedData);

        $submit = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        if (!$submit) {
            return redirect("/tambahUser")->with('error', 'Error');
        } else {
            Mail::send('email.inputPassword', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Verify Email & Input Password');
            });
        }

        return redirect("/daftar-user")->with('success', 'Tambah User Berhasil!');
    }

    public function passwordForm($token)
    {
        $reset = DB::table('password_resets')->where('token', $token)->get();
        return view('auth.passwords.input', ['token' => $token, 'reset' => $reset]);
    }

    public function inputPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Email yang anda input salah!');
        }

        User::where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password),
                'email_verified_at' => Carbon::now(),
                'is_email_verified' => 1
            ]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('success', 'Silahkan login dengan akun anda!');
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
            'role' => $data['role'],
            'sekolah_id' => $sekolah_id
        ]);
    }
}
