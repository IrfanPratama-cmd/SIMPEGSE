<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\Sekolah;
use App\Models\Setting;
use App\Models\Tunjangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard')
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("login")->with('error', 'Login Gagal!, Email atau Password anda salah!.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $createUser = $this->create($data);

        // $validatedData = $request->validate([
        //     'name' => 'required|max:255',
        //     'alamat' => 'required',
        //     'no_telp' => 'required|max:255',
        // ]);

        $validatedData['user_id'] = $createUser->id;

        $validatedData3['user_id'] = $createUser->id;

        $validatedData['nama_sekolah'] = $createUser->name;

        // $sekolah = Sekolah::create($validatedData);

        Sekolah::create($validatedData);

        $validatedData2['user_id'] = $createUser->id;
        $validatedData2['tunjangan_pasangan'] = 0;
        $validatedData2['tunjangan_anak'] = 0;
        $validatedData2['tunjangan_pangan'] = 0;

        Setting::create($validatedData3);

        Tunjangan::create($validatedData2);

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $createUser->id,
            'token' => $token
        ]);

        Mail::send('auth.verify', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });

        return redirect("/login")->with('success', 'Registrasi berhasil. Silahkan buka email anda untuk verifikasi.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return view('admin.index');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => "Admin"
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('login')->with('message', $message);
    }
}
