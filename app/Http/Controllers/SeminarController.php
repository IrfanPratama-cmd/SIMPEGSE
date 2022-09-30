<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Seminar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class SeminarController extends Controller
{
    public function index()
    {
        $seminar = Seminar::where('user_id', auth()->user()->id)->get();

        return view('seminar.index', [
            'seminar' => $seminar
        ]);
    }

    public function tambahSeminar()
    {
        return view('seminar.tambah');
    }

    public function simpanSeminar(Request $request)
    {
        $validatedData = $request->validate([
            'nama_seminar' => 'required|max:255',
            'penyelenggara' => 'required',
            'tempat_seminar' => 'required|max:255',
            'tanggal' => 'required|max:255',
            'bukti_seminar' => 'required',
        ]);

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$pegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];
        $nama_pegawai = $get2['nama_lengkap'];

        // $validatedData['pegawai_id'] = $pegawai_id;

        // $validatedData['user_id'] = auth()->user()->id;

        // $validatedData['bukti_seminar'] = $request->file('bukti_seminar')->store('seminar');

        $folder = "bukti-seminar";

        $file = $request->file('bukti_seminar');

        $extension = $request->file('bukti_seminar')->getClientOriginalExtension();

        $nama = $nama_pegawai  . '_' .  $folder . '.' . $extension;

        $file->move($folder, $nama);

        $validatedData['bukti_seminar'] = $nama;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['pegawai_id'] = $pegawai_id;

        Seminar::create($validatedData);

        return redirect('/seminar')->with('success', 'Data Seminar Berhasil di Tambah');
    }

    public function detailSeminar($id, Seminar $seminar)
    {
        $id = Crypt::decrypt($id);
        $seminar = Seminar::findOrFail($id);

        return view('seminar.detail', [
            'seminar' => $seminar
        ]);
    }

    public function editSeminar($id, Seminar $seminar)
    {
        $id = Crypt::decrypt($id);
        $seminar = Seminar::findOrFail($id);

        return view('seminar.edit', [
            'seminar' => $seminar
        ]);
    }

    public function updateSeminar($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nama_seminar' => 'required|max:255',
            'penyelenggara' => 'required',
            'tempat_seminar' => 'required|max:255',
            'tanggal' => 'required|max:255',
            'bukti_seminar' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        if ($request->file('bukti_seminar')) {
            // if ($request->oldImage) {
            //     Storage::delete($request->oldImage);
            // }
            // $validatedData['bukti_seminar'] = $request->file('bukti_seminar')->store('seminar');

            $folder = "bukti-seminar";

            $file = $request->file('bukti_seminar');

            $extension = $request->file('bukti_seminar')->getClientOriginalExtension();

            $nama = $pegawai->nama_lengkap  . '_' .  $folder . '.' . $extension;

            $file->move($folder, $nama);

            $validatedData['bukti_seminar'] = $nama;
        }

        Seminar::where('id', $id)
            ->update($validatedData);

        return redirect('/seminar')->with('success', 'Riwayat Seminar Berhasil di Update');
    }

    public function hapusSeminar($id)
    {
        $id = Crypt::decrypt($id);
        Seminar::destroy($id);

        return redirect('/seminar')->with('success', 'Riwayat Seminar Berhasil di Hapus');
    }
}
