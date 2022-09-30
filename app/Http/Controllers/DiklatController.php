<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class DiklatController extends Controller
{
    public function index()
    {
        $diklat = Diklat::where('user_id', auth()->user()->id)->get();

        return view('diklat.index', [
            'diklat' => $diklat
        ]);
    }

    public function tambahDiklat()
    {
        return view('diklat.tambah');
    }

    public function simpanDiklat(Request $request)
    {
        $validatedData = $request->validate([
            'nama_diklat' => 'required|max:255',
            'penyelenggara' => 'required',
            'tempat_diklat' => 'required|max:255',
            'tanggal' => 'required|max:255',
            'bukti_diklat' => 'required',
        ]);

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$pegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];
        $nama_pegawai = $get2['nama_lengkap'];

        $validatedData['pegawai_id'] = $pegawai_id;

        $validatedData['user_id'] = auth()->user()->id;

        // $validatedData['bukti_diklat'] = $request->file('bukti_diklat')->store('diklat');

        $folder = "bukti-diklat";

        $file = $request->file('bukti_diklat');

        $extension = $request->file('bukti_diklat')->getClientOriginalExtension();

        $nama = $nama_pegawai  . '_' .  $folder . '.' . $extension;

        $file->move($folder, $nama);

        $validatedData['bukti_diklat'] = $nama;

        Diklat::create($validatedData);

        return redirect('/diklat')->with('success', 'Data Diklat Berhasil di Tambah');
    }

    public function detailDiklat($id, Diklat $diklat)
    {
        $id = Crypt::decrypt($id);
        $diklat = Diklat::findOrFail($id);

        return view('diklat.detail', [
            'diklat' => $diklat
        ]);
    }

    public function editDiklat($id, Diklat $diklat)
    {
        $id = Crypt::decrypt($id);
        $diklat = Diklat::findOrFail($id);

        return view('diklat.edit', [
            'diklat' => $diklat
        ]);
    }

    public function updateDiklat($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nama_diklat' => 'required|max:255',
            'penyelenggara' => 'required',
            'tempat_diklat' => 'required|max:255',
            'tanggal' => 'required|max:255',
            // 'bukti_diklat' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        if ($request->file('bukti_diklat')) {
            // if ($request->oldImage) {
            //     Storage::delete($request->oldImage);
            // }
            // $validatedData['bukti_diklat'] = $request->file('bukti_diklat')->store('diklat');

            $folder = "bukti-diklat";

            $file = $request->file('bukti_diklat');

            $extension = $request->file('bukti_diklat')->getClientOriginalExtension();

            $nama = $pegawai->nama_lengkap  . '_' .  $folder . '.' . $extension;

            $file->move($folder, $nama);

            $validatedData['bukti_diklat'] = $nama;
        }

        Diklat::where('id', $id)
            ->update($validatedData);

        return redirect('/diklat')->with('success', 'Riwayat Diklat Berhasil di Update');
    }

    public function hapusDiklat($id)
    {
        $id = Crypt::decrypt($id);
        Diklat::destroy($id);

        return redirect('/diklat')->with('success', 'Riwayat Diklat Berhasil di Hapus');
    }
}
