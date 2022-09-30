<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Dokumen;
use App\Models\Pegawai;
use App\Models\Sekolah;
use App\Models\TMDokumen;
use Carbon\Carbon;
use Response;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Redirect;

class DokumenController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        return view('dokumen.index', [
            'dokumen' => TMDokumen::where('sekolah_id', $sekolah_id)->where('kategori', 'Pegawai')->orderBy('created_at', 'desc')->paginate(4)
        ]);
    }

    public function dokumenTabel()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        return view('dokumen.tabel', [
            'dokumen' => TMDokumen::where('sekolah_id', $sekolah_id)->where('kategori', 'Pegawai')
                ->orderBy('created_at', 'desc')->paginate(6)
        ]);
    }

    public function tambahDokumen()
    {
        return view('dokumen.tambah');
    }

    public function simpanDokumen(Request $request)
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];

        $validatedData = $request->validate([
            'nama_dokumen' => 'required',
            'folder' => 'required',
            'tanggal' => 'required',
            // 'kategori' => 'required'
        ]);

        $validatedData['keterangan'] = $request->keterangan;
        $validatedData['sekolah_id'] = $sekolah_id;
        $validatedData['kategori'] = "Pegawai";

        TMDokumen::create($validatedData);

        return redirect('/dokumen')->with('success', 'Dokumen Berhasil di Tambah');
    }

    public function detailDokumen($id, TMDokumen $dokumen)
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

            return view('dokumen.dokumen', [
                'dokumen' => $dokumen,
                'cekDokumen' => $cekDokumen,
                'nama_file' => $nama_file,
                'tanggal_upload' => $tanggal_upload,
                'waktu_upload' => $waktu_upload,
                'id' => $id
            ]);
        } else {
            return view('dokumen.dokumen', [
                'dokumen' => $dokumen,
                'cekDokumen' => $cekDokumen,
            ]);
        }
    }

    public function dokumenPegawai()
    {
        $pegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$pegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];
        $sekolah_id = $get2['sekolah_id'];

        return view('dokumen.listPegawai', [
            'dokumen' => TMDokumen::where('sekolah_id', $sekolah_id)->where("kategori", "Pegawai")
                ->orderBy('tanggal', 'desc')->paginate(4)
        ]);
    }

    public function uploadDokumen(Request $request)
    {
        $getPegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$getPegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];
        $sekolah_id = $get2['sekolah_id'];
        $nama_pegawai = $get2['nama_lengkap'];

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

        $nama = $nama_pegawai . '_' .  $folder . '_' . $tanggal . '.' . $extension;

        // $tanggal = date_create();

        // dd($request);



        $file->move($folder, $nama);

        // Storage::putFile($folder, $nama_file);

        // if ($request->file('nama_file')) {
        //     $validatedData['nama_file'] = $request->file('nama_file')->store($folder);
        // }

        $validatedData['nama_file'] = $nama;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['sekolah_id'] = $sekolah_id;
        $validatedData['pegawai_id'] = $pegawai_id;
        $validatedData['tanggal_upload'] = $tanggal;
        $validatedData['waktu_upload'] = $localtime;
        $validatedData['size'] = $size;
        $validatedData['extension'] = $extension;

        Dokumen::create($validatedData);

        return Redirect::back()->with('success', 'File Berhasil di Upload');
    }

    public function downloadFile($nama_file, $folder)
    {
        $filepath = public_path($nama_file . '/' . $folder);
        return Response::download($filepath);
    }

    public function editFile($id)
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

        return view('dokumen.editFile', [
            'dokumen' => $dokumen,
            'nama_dokumen' => $nama_dokumen,
            'keterangan' => $keterangan,
            'id' => $id
        ]);
    }

    public function updateFile($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $getPegawai = Pegawai::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$getPegawai;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $pegawai_id = $get2['id'];
        $sekolah_id = $get2['sekolah_id'];
        $nama_pegawai = $get2['nama_lengkap'];

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

            $size = $request->file('nama_file')->getSize();

            $nama_file = $file->getClientOriginalName();

            $extension = $request->file('nama_file')->getClientOriginalExtension();

            $nama = $nama_pegawai . '_' .  $folder . '_' . $tanggal . '.' . $extension;

            $file->move($folder, $nama);

            // if ($request->oldImage) {
            //     Storage::delete($request->oldImage);
            // }
        }

        $validatedData['nama_file'] = $nama;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['sekolah_id'] = $sekolah_id;
        $validatedData['pegawai_id'] = $pegawai_id;
        $validatedData['tanggal_upload'] = $tanggal;
        $validatedData['waktu_upload'] = $localtime;
        $validatedData['size'] = $size;

        Dokumen::where('id', $id)
            ->update($validatedData);

        return redirect('/dokumenPegawai')->with('success', 'Dokumen Berhasil di Update');
    }

    public function allDokumen($id)
    {
        $id = Crypt::decrypt($id);

        $Tmdokumen = TMDokumen::findOrFail($id);
        $dokumen = Dokumen::where('dokumen_id', $id)->get();

        return view('dokumen.allDokumen', [
            'dokumen' => $dokumen,
            'Tmdokumen' => $Tmdokumen
        ]);
    }

    public function downloadDokumen($nama_file, $folder)
    {
        $filepath = public_path($nama_file . '/' . $folder);
        return Response::download($filepath);
    }

    public function hapusFile($id)
    {
        $id = Crypt::decrypt($id);
        Dokumen::destroy($id);

        return Redirect::back()->with('success', 'File Berhasil di Hapus');
    }

    public function dokumenManager()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        return view('manager.folder', [
            'dokumen' => TMDokumen::where('sekolah_id', $sekolah_id)->where('kategori', 'Pegawai')->get()
        ]);
    }

    public function dokManagerSiswa()
    {
        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        return view('manager.folder', [
            'dokumen' => TMDokumen::where('sekolah_id', $sekolah_id)->where('kategori', 'Siswa')->get()
        ]);
    }

    public function cariDokManager(Request $request)
    {
        $cari = $request->caridok;

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->get()->toArray();
        $objectToArray = (array)$sekolah;
        $get1 = $objectToArray[0];
        $get2 = (array)$get1;
        $sekolah_id = $get2['id'];
        $nama_sekolah = $get2['nama_sekolah'];

        $dokumen = TMDokumen::where('nama_dokumen', 'like', "%" . $cari . "%")
            ->where('sekolah_id', $sekolah_id)->get();

        return view('manager.folder', [
            'dokumen' => $dokumen
        ]);
    }

    public function dokumenTabelPegawai()
    {
        return view('dokumen.tabelPegawai', [
            'dokumen' => TMDokumen::orderBy('created_at', 'desc')->paginate(6)
        ]);
    }

    public function cariDokTabelPegawai(Request $request)
    {
        $cari = $request->caridok;

        $dokumen = TMDokumen::where('nama_dokumen', 'like', "%" . $cari . "%")->paginate(5);

        return view('dokumen.tabelPegawai', ['dokumen' => $dokumen]);
    }

    public function cariDokTabel(Request $request)
    {
        $cari = $request->caridok;

        $dokumen = TMDokumen::where('nama_dokumen', 'like', "%" . $cari . "%")->paginate(5);

        return view('dokumen.tabel', ['dokumen' => $dokumen]);
    }

    public function cariDokList(Request $request)
    {
        $cari = $request->caridok;

        $dokumen = TMDokumen::where('nama_dokumen', 'like', "%" . $cari . "%")->paginate(5);

        return view('dokumen.index', ['dokumen' => $dokumen]);
    }

    public function cariDokListPegawai(Request $request)
    {
        $cari = $request->caridok;

        $dokumen = TMDokumen::where('nama_dokumen', 'like', "%" . $cari . "%")->paginate(5);

        return view('dokumen.listPegawai', ['dokumen' => $dokumen]);
    }

    public function editDokumen($id)
    {
        $id = Crypt::decrypt($id);

        $dokumen = TMDokumen::findOrFail($id);

        $sekolah = Sekolah::where('user_id', auth()->user()->id)->first();

        $angkatan = Angkatan::Where('sekolah_id', $sekolah->id)->get();

        return view('dokumen.editDokumen', [
            'dokumen' => $dokumen,
            'angkatan' => $angkatan
        ]);
    }

    public function updateDokumen($id, Request $request)
    {
        $id = Crypt::decrypt($id);

        $rules = [
            'nama_dokumen' => 'required',
            'folder' => 'required',
            'tanggal' => 'required',
            // 'kategori' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['angkatan_id'] = $request->angkatan_id;

        // dd($request);

        TMDokumen::where('id', $id)
            ->update($validatedData);

        if ($request->kategori == "Pegawai") {
            return redirect('/dokumenTabel')->with('success', 'Dokumen Pegawai Berhasil di Update');
        } elseif ($request->kategori == "Siswa") {
            return redirect('/dokTabelSiswa')->with('success', 'Dokumen Siswa Berhasil di Update');
        }
    }

    public function hapusDokumen($id)
    {
        $id = Crypt::decrypt($id);

        TMDokumen::destroy($id);

        return redirect('/dokumenTabel')->with('success', 'Dokumen Berhasil di Hapus');
    }
}
