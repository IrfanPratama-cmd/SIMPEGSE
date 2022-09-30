<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class OrganisasiController extends Controller
{
    public function index()
    {
        $organisasi = Organisasi::where('user_id', auth()->user()->id)->get();

        return view('organisasi.index', [
            'organisasi' => $organisasi
        ]);
    }

    public function tambahOrganisasi()
    {
        return view('organisasi.tambah');
    }

    public function simpanOrganisasi(Request $request)
    {
        $validatedData = $request->validate([
            'nama_organisasi' => 'required|max:255',
            'bidang_organisasi' => 'required',
            'jabatan' => 'required|max:255',
            'periode' => 'required|max:255',
            'bukti_organisasi' => 'required',
        ]);

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$pegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];
        $nama_pegawai = $get2['nama_lengkap'];

        $validatedData['pegawai_id'] = $pegawai_id;

        $validatedData['user_id'] = auth()->user()->id;

        // $validatedData['bukti_organisasi'] = $request->file('bukti_organisasi')->store('organisasi');

        $folder = "bukti-organisasi";

        $file = $request->file('bukti_organisasi');

        $extension = $request->file('bukti_organisasi')->getClientOriginalExtension();

        $nama = $nama_pegawai  . '_' .  $folder . '.' . $extension;

        $file->move($folder, $nama);

        $validatedData['bukti_organisasi'] = $nama;

        Organisasi::create($validatedData);

        return redirect('/riwayatorganisasi')->with('success', 'Data Organisasi Berhasil di Tambah');
    }

    public function detailOrganisasi($id, Organisasi $Organisasi)
    {
        $id = Crypt::decrypt($id);
        $organisasi = Organisasi::findOrFail($id);

        return view('organisasi.detail', [
            'organisasi' => $organisasi
        ]);
    }

    public function editOrganisasi($id, Organisasi $organisasi)
    {
        $id = Crypt::decrypt($id);
        $organisasi = Organisasi::findOrFail($id);

        return view('organisasi.edit', [
            'organisasi' => $organisasi
        ]);
    }

    public function updateOrganisasi($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nama_organisasi' => 'required|max:255',
            'bidang_organisasi' => 'required',
            'jabatan' => 'required|max:255',
            'periode' => 'required|max:255',
            'bukti_organisasi' => 'required',
        ];

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        $validatedData = $request->validate($rules);

        $folder = "bukti-organisasi";

        if ($request->file('bukti_organisasi')) {
            // if ($request->oldImage) {
            //     Storage::delete($request->oldImage);
            // }
            // $validatedData['bukti_organisasi'] = $request->file('bukti_organisasi')->store('organisasi');
            $file = $request->file('bukti_organisasi');

            $extension = $request->file('bukti_organisasi')->getClientOriginalExtension();

            $nama = $pegawai->nama_lengkap  . '_' .  $folder . '.' . $extension;

            $file->move($folder, $nama);

            $validatedData['bukti_organisasi'] = $nama;
        }

        Organisasi::where('id', $id)
            ->update($validatedData);

        return redirect('/riwayatorganisasi')->with('success', 'Riwayat Organisasi Berhasil di Update');
    }

    public function hapusOrganisasi($id)
    {
        $id = Crypt::decrypt($id);
        Organisasi::destroy($id);

        return redirect('/riwayatorganisasi')->with('success', 'Riwayat Organisasi Berhasil di Hapus');
    }
}
