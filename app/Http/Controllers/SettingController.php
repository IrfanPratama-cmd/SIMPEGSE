<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting.index', [
            'setting' => Setting::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function editSetting($id, Setting $setting)
    {
        $id = Crypt::decrypt($id);
        $setting = Setting::findOrFail($id);

        return view('setting.edit', [
            'setting' => $setting
        ]);
    }

    public function updateSetting($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $rules = [
            'cuti' => 'required|max:255',
            'jam_masuk' => 'required|max:255',
            'jam_pulang' => 'required|max:255',
            'jam_absen' => 'required|max:255',
            'kepala_sekolah' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $validatedData['sekolah_id'] = $sekolah->id;

        if ($request->file('ttd_pimpinan')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['ttd_pimpinan'] = $request->file('ttd_pimpinan')->store('ttd-pimpminan');
        }

        Setting::where('id', $id)
            ->update($validatedData);

        return redirect('/setting')->with('success', 'Setting Berhasil di Update');
    }
}
