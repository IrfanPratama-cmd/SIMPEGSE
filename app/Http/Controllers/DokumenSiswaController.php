<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\Pegawai;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\TMDokumen;
use Carbon\Carbon;
use Response;
use File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Redirect;

class DokumenSiswaController extends Controller
{
    public function dokumenSiswa()
    {
        $siswa = Siswa::where('user_id', auth()->user()->id)->first();

        return view('dokSiswa.list', [
            'dokumen' => TMDokumen::where('sekolah_id', $siswa->sekolah_id)->where("kategori", "Siswa")
                ->where('angkatan_id', $siswa->angkatan_id)->orderBy('tanggal', 'desc')->paginate(4)
        ]);
    }

    public function uploadDokumenSiswa(Request $request)
    {
        // dd($request);

        $siswa = Siswa::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$siswa;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $siswa_id = $get2['id'];
        $sekolah_id = $get2['sekolah_id'];

        $getFolder = TMDokumen::where('id', $request->dokumen_id)->get()->toArray();
        $objectToArray = (array)$getFolder;
        $get3 = $objectToArray[0];
        $get4 = (array)$get3;
        $folder = $get4['folder'];

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        // $tanggal = $date->format('Y-m-d');
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $localtime = $date->format('H:i:s');

        $validatedData = $request->validate([
            'nama_file' => 'required',
            'dokumen_id' => 'required'
        ]);

        $file = $request->file('nama_file');

        $size = $request->file('nama_file')->getSize();

        $nama_file = $file->getClientOriginalName();

        $extension = $request->file('nama_file')->getClientOriginalExtension();

        $file->move($folder, $file->getClientOriginalName());

        // Storage::putFile($folder, $nama_file);

        // if ($request->file('nama_file')) {
        //     $validatedData['nama_file'] = $request->file('nama_file')->store($folder);
        // }

        $validatedData['nama_file'] = $nama_file;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['sekolah_id'] = $sekolah_id;
        $validatedData['siswa_id'] = $siswa_id;
        $validatedData['tanggal_upload'] = $tanggal;
        $validatedData['waktu_upload'] = $localtime;
        $validatedData['size'] = $size;
        $validatedData['extension'] = $extension;

        Dokumen::create($validatedData);

        return Redirect::back()->with('success', 'File Berhasil di Upload');
    }

    public function detailDokumenSiswa($id, TMDokumen $dokumen)
    {
        $id = Crypt::decrypt($id);
        $dokumen = TMDokumen::findOrFail($id);

        $cekDokumen = Dokumen::where('dokumen_id', $id)->where('user_id', auth()->user()->id)->count();

        if ($cekDokumen >= 1) {
            $getDokumen = Dokumen::where('dokumen_id', $id)->where('user_id', auth()->user()->id)->get()->toArray();
            $objectToArray = (array)$getDokumen;
            $get1 = $objectToArray[0];
            $get2 = (array)$get1;
            $nama_file = $get2['nama_file'];
            $waktu_upload = $get2['waktu_upload'];
            $tanggal_upload = $get2['tanggal_upload'];
            $id = $get2['id'];

            $files = Storage::files('');

            return view('dokSiswa.detail', [
                'dokumen' => $dokumen,
                'cekDokumen' => $cekDokumen,
                'nama_file' => $nama_file,
                'tanggal_upload' => $tanggal_upload,
                'waktu_upload' => $waktu_upload,
                'id' => $id
            ]);
        } else {
            return view('dokSiswa.detail', [
                'dokumen' => $dokumen,
                'cekDokumen' => $cekDokumen,
            ]);
        }
    }

    public function editFileSiswa($id)
    {
        $id = Crypt::decrypt($id);
        $dokumen = Dokumen::findOrFail($id);

        $getDokID = Dokumen::where('id', $id)->get()->toArray();
        $objectToArray = (array)$getDokID;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $dokumen_id = $get2['dokumen_id'];

        $Tmdokumen = TMDokumen::where('id', $dokumen_id)->get()->toArray();
        $objectToArray = (array)$Tmdokumen;
        $get3 = $objectToArray[0];
        $get4 = (array)$get3;
        $nama_dokumen = $get4['nama_dokumen'];
        $keterangan = $get4['keterangan'];
        $id = $get4['id'];

        return view('dokSiswa.edit', [
            'dokumen' => $dokumen,
            'nama_dokumen' => $nama_dokumen,
            'keterangan' => $keterangan,
            'id' => $id
        ]);
    }

    public function updateFileSiswa($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $siswa = Siswa::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$siswa;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $siswa_id = $get2['id'];
        $sekolah_id = $get2['sekolah_id'];

        $getDokID = Dokumen::where('id', $id)->get()->toArray();
        $objectToArray = (array)$getDokID;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $dokumen_id = $get2['dokumen_id'];
        $nama_file = $get2['nama_file'];

        $Tmdokumen = TMDokumen::where('id', $dokumen_id)->get()->toArray();
        $objectToArray = (array)$Tmdokumen;
        $get3 = $objectToArray[0];
        $get4 = (array)$get3;
        $folder = $get4['folder'];

        $rules = [
            'nama_file' => 'required',
            'dokumen_id' => 'required'
        ];

        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now', new DateTimeZone($timezone));
        // $tanggal = $date->format('Y-m-d');
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $localtime = $date->format('H:i:s');

        if ($request->file('nama_file')) {

            File::delete(public_path($nama_file . '/' . $folder));

            $file = $request->file('nama_file');

            $nama_file = $file->getClientOriginalName();

            $file->move($folder, $file->getClientOriginalName());

            // if ($request->oldImage) {
            //     Storage::delete($request->oldImage);
            // }
        }

        $validatedData['nama_file'] = $nama_file;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['sekolah_id'] = $sekolah_id;
        $validatedData['siswa_id'] = $siswa_id;
        $validatedData['tanggal_upload'] = $tanggal;
        $validatedData['waktu_upload'] = $localtime;

        Dokumen::where('id', $id)
            ->update($validatedData);

        return redirect('/dokumenSiswa')->with('success', 'Dokumen Berhasil di Update');
    }

    public function index()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        return view('dokSiswa.index', [
            'dokumen' => TMDokumen::where('sekolah_id', $sekolah_id)->where('kategori', 'Siswa')->orderBy('created_at', 'desc')->paginate(4)
        ]);
    }

    public function tambahDokSiswa()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $angkatan = Angkatan::where('sekolah_id', $sekolah->id)->get();

        return view('dokSiswa.tambah', [
            'angkatan' => $angkatan
        ]);
    }

    public function simpanDokSiswa(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $validatedData = $request->validate([
            'nama_dokumen' => 'required',
            'folder' => 'required',
            'tanggal' => 'required',
            'angkatan_id' => 'required'
        ]);

        $validatedData['keterangan'] = $request->keterangan;
        $validatedData['sekolah_id'] = $sekolah->id;
        $validatedData['kategori'] = "Siswa";

        TMDokumen::create($validatedData);

        return redirect('/dokSiswa')->with('success', 'Dokumen Berhasil di Tambah');
    }

    public function fileManagerSiswa()
    {
        $siswa = Siswa::where('user_id', auth()->user()->id)->first();

        $dokumen = Dokumen::where('user_id', auth()->user()->id)->get();

        return view('dokSiswa.fileManager', [
            'dokumen' => $dokumen
        ]);
    }

    public function dokTabelSiswa()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        return view('dokSiswa.tabel', [
            'dokumen' => TMDokumen::where('sekolah_id', $sekolah_id)->where('kategori', 'Siswa')
                ->orderBy('created_at', 'desc')->paginate(6)
        ]);
    }

    public function hapusDokumenSiswa($id)
    {
        $id = Crypt::decrypt($id);

        TMDokumen::destroy($id);

        return redirect('/dokSiswa')->with('success', 'Dokumen Siswa Berhasil di Hapus');
    }
}
