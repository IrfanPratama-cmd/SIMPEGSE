<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class SekolahController extends Controller
{
    public function profileSekolah()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get();

        return view('sekolah.profile', [
            'sekolah' => $sekolah
        ]);
    }

    public function editProfileSekolah($id)
    {
        $id = Crypt::decrypt($id);

        $sekolah = Sekolah::findOrFail($id);

        return view('sekolah.editProfile', [
            'sekolah' => $sekolah
        ]);
    }

    public function updateProfileSekolah($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nama_sekolah' => 'required|max:255',
            'alamat' => 'required',
            'no_telp' => 'required|max:255',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('foto_sekolah')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['foto_sekolah'] = $request->file('foto_sekolah')->store('foto-sekolah');
        }

        Sekolah::where('id', $id)
            ->update($validatedData);

        return redirect('/profileSekolah')->with('success', 'Profile Sekolah Berhasil di Update');
    }
}
