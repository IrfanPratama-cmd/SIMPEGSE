<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Tunjangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TunjanganController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $tunjangan = Tunjangan::where('user_id', auth()->user()->id)->get();

        return view('tunjangan.index', [
            'tunjangan' => $tunjangan
        ]);
    }

    public function editTunjangan($id)
    {
        $id = Crypt::decrypt($id);

        $tunjangan = Tunjangan::findOrFail($id);

        return view('tunjangan.edit', [
            'tunjangan' => $tunjangan
        ]);
    }

    public function updateTunjangan($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $rules = [
            'tunjangan_pasangan' => 'required|max:255',
            'tunjangan_anak' => 'required',
            'tunjangan_pangan' => 'required|max:255',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['sekolah_id'] = $sekolah->id;

        Tunjangan::where('id', $id)
            ->update($validatedData);

        return redirect('/tunjangan')->with('success', 'Profile Sekolah Berhasil di Update');
    }
}
