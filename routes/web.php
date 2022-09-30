<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AsnController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DokumenSiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PppkController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TunjanganController;
use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Pendidikan;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/test', function () {
    Storage::disk('google')->put('test.txt', 'Hello World');
});

Route::get('/test2', function () {
    Storage::disk('google')->put('test.doc', 'Hello World');
});

Route::get('/make1', function () {
    $folder = "Coba";
    $test = Storage::disk('google')->makeDirectory($folder);
    dd($test);
});

Route::get('/cobaUpload', function () {
    return view('upload');
});

// Route::get('/location', function () {
//     dd(Location::get('36.65.126.188'));
// });

// Route::post('/cobaUpload', function (Request $request) {

//     // dd($request->file("coba")->store("", "google"));
//     $file = $request->file('coba');
//     $nama_file = $file->getClientOriginalName();
//     Storage::disk("google")->putFileAs("1RVYWySuXFIihxbWRPjJjnvnFvQ5WRsNm", $request->file("coba"), $nama_file);
//     // Storage::disk('google')->move('', $nama_file);
//     // $file->move("Coba", $file->getClientOriginalName());
// });

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'registration'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/* New Added Routes */
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['is_verify_email']);
Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');

// Forget Password
Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Input Password User
Route::get('/input-password/{token}', [UserController::class, 'passwordForm'])->name('input.password.get');
Route::post('input-password', [UserController::class, 'inputPassword']);

//Group
Route::group(['middleware' => ['is_verify_email', 'role:Super Admin']], function () {
    Route::get('/dataSekolah', [SuperAdminController::class, 'dataSekolah']);

    Route::get('/masterAsn', [AsnController::class, 'index']);
    Route::post('/tambahMasterAsn', [AsnController::class, 'tambah']);


    Route::get('/masterPppk', [PppkController::class, 'index']);
    Route::post('/tambahMasterPppk', [PppkController::class, 'tambah']);
});


Route::group(['middleware' => ['is_verify_email', 'role:Admin']], function () {
    //Profile Sekolah
    Route::get('/profileSekolah', [SekolahController::class, 'profileSekolah']);
    Route::get('/editProfileSekolah/{id}', [SekolahController::class, 'editProfileSekolah']);
    Route::put('/updateProfileSekolah/{id}', [SekolahController::class, 'updateProfileSekolah']);

    Route::get('/daftar-user', [UserController::class, 'index']);
    Route::put('/verifUser/{id}', [UserController::class, 'verifUser']);
    Route::put('/hapusVerif/{id}', [UserController::class, 'hapusVerif']);
    Route::get('/tambahUser', [UserController::class, 'tambahUser']);
    Route::post('/tambahData', [UserController::class, 'tambahData']);
    Route::get('/profileAdmin', [UserController::class, 'profileAdmin']);
    Route::get('/editAdmin/{id}', [UserController::class, 'editAdmin']);
    Route::put('/updateAdmin/{id}', [UserController::class, 'updateAdmin']);
    Route::get('/detailInstansi/{id}', [InstansiController::class, 'detailInstansi']);
    Route::get('/cariUser', [UserController::class, 'cariUser']);

    Route::get('daftar-pegawai', [PegawaiController::class, 'dataPegawai']);
    Route::get('/cariPegawai', [PegawaiController::class, 'cariPegawai']);

    Route::get('/profilePegawai/{id}', [PegawaiController::class, 'profilePegawai']);
    Route::get('/data-keluarga/{id}', [PegawaiController::class, 'dataKeluarga']);
    Route::get('/ortu/{id}', [PegawaiController::class, 'ortu']);
    Route::get('/detailOrtuPegawai/{id}', [PegawaiController::class, 'detailOrtuPegawai']);
    Route::get('/pasangan/{id}', [PegawaiController::class, 'pasangan']);
    Route::get('/detailPasanganPegawai/{id}', [PegawaiController::class, 'detailPasanganPegawai']);
    Route::get('/anak/{id}', [PegawaiController::class, 'anak']);
    Route::get('/detailAnakPegawai/{id}', [PegawaiController::class, 'detailAnakPegawai']);

    Route::get('/pendidikan/{id}', [PegawaiController::class, 'pendidikan']);
    Route::get('/detailPendidikanPegawai/{id}', [PegawaiController::class, 'detailPendidikan']);

    Route::get('/riwayatorganisasi/{id}', [PegawaiController::class, 'organisasi']);
    Route::get('/detailOrganisasiPegawai/{id}', [PegawaiController::class, 'detailOrganisasi']);

    Route::get('/diklat/{id}', [PegawaiController::class, 'diklat']);
    Route::get('/detailDiklatPegawai/{id}', [PegawaiController::class, 'detailDiklat']);

    Route::get('/seminar/{id}', [PegawaiController::class, 'seminar']);
    Route::get('/detailSeminarPegawai/{id}', [PegawaiController::class, 'detailSeminar']);

    Route::get('/detailPegawai/{id}', [PegawaiController::class, 'detailPegawai']);
    Route::get('/detailProfile/{id}', [PegawaiController::class, 'detailProfile']);
    Route::get('/editPegawaiAdmin/{id}', [PegawaiController::class, 'editPegawai']);
    Route::put('/updatePegawaiAdmin/{id}', [PegawaiController::class, 'updatePegawai']);

    //Absensi
    Route::get('/data-absensi', [AbsensiController::class, 'index']);
    Route::post('/buatAbsen', [AbsensiController::class, 'buatAbsen']);
    Route::delete('/hapusAbsen/{id}', [AbsensiController::class, 'hapusAbsen']);
    Route::get('/rekapAbsen/{id}', [AbsensiController::class, 'rekapAbsen']);

    //Jabatan
    // Route::resource('jabatan', JabatanController::class);
    Route::get('/jabatan', [JabatanController::class, 'index']);
    Route::get('/detailJabatan/{id}', [JabatanController::class, 'detailJabatan']);
    Route::post('/tambahJabatan', [JabatanController::class, 'tambahJabatan']);
    Route::delete('/hapusJabatan/{id}', [JabatanController::class, 'hapusJabatan']);
    Route::get('/editJabatan/{id}', [JabatanController::class, 'editJabatan']);
    Route::put('/updateJabatan/{id}', [JabatanController::class, 'updateJabatan']);

    Route::get('/jabatanPegawai', [JabatanController::class, 'jabatanPegawai']);
    Route::get('/detailJabatanPegawai/{id}', [JabatanController::class, 'detailJabatanPegawai']);
    Route::post('/tambahJabatanPegawai', [JabatanController::class, 'tambahJabatanPegawai']);
    Route::delete('/hapusJabatanPegawai/{id}', [JabatanController::class, 'hapusJabatanPegawai']);
    Route::get('/editJabatanPegawai/{id}', [JabatanController::class, 'editJabatanPegawai']);
    Route::put('/updateJabatanPegawai/{id}', [JabatanController::class, 'updateJabatanPegawai']);

    //Mapel
    // Route::resource('jabatan', JabatanController::class);
    Route::get('/mapel', [MapelController::class, 'index']);
    Route::get('/detailMapel/{id}', [MapelController::class, 'detailMapel']);
    Route::post('/tambahMapel', [MapelController::class, 'tambahMapel']);
    Route::delete('/hapusMapel/{id}', [MapelController::class, 'hapusMapel']);
    Route::get('/editMapel/{id}', [MapelController::class, 'editMapel']);
    Route::put('/updateMapel/{id}', [MapelController::class, 'updateMapel']);

    Route::get('/mapelGuru', [MapelController::class, 'mapelGuru']);
    Route::get('/detailMapelGuru/{id}', [MapelController::class, 'detailMapelGuru']);
    Route::post('/tambahMapelGuru', [MapelController::class, 'tambahMapelGuru']);
    Route::delete('/hapusMapelGuru/{id}', [MapelController::class, 'hapusMapelGuru']);
    Route::get('/editMapelGuru/{id}', [MapelController::class, 'editMapelGuru']);
    Route::put('/updateMapelGuru/{id}', [MapelController::class, 'updateMapelGuru']);

    //Gaji Pegawai
    Route::get('/gajiPegawai', [GajiController::class, 'gajiPegawai']);
    Route::get('/rekapGajiPegawai', [GajiController::class, 'rekapGajiPegawai']);
    Route::get('/bulanGajiPegawai', [GajiController::class, 'bulanGajiPegawai']);
    Route::get('/detailGajiPegawai/{id}', [GajiController::class, 'detailGajiPegawai']);
    Route::get('/downloadGajiPegawai/{id}', [GajiController::class, 'downloadGajiPegawai']);
    Route::post('/tambahGajiPegawai', [GajiController::class, 'tambahGajiPegawai']);
    Route::get('/bayarGajiPegawai/{id}', [GajiController::class, 'bayarGajiPegawai']);
    Route::put('/bayarPegawai/{id}', [GajiController::class, 'bayarPegawai']);
    Route::delete('/hapusGajiPegawai/{id}', [GajiController::class, 'hapusGajiPegawai']);
    Route::get('/riwayatGaji', [GajiController::class, 'riwayatGaji']);
    Route::get('/detailRiwayatGaji/{id}', [GajiController::class, 'detailRiwayatGaji']);

    //Gaji Guru
    Route::get('/gajiGuru', [GajiController::class, 'gajiGuru']);
    Route::get('/rekapGajiGuru', [GajiController::class, 'rekapGajiGuru']);
    Route::post('/tambahGajiGuru', [GajiController::class, 'tambahGajiGuru']);
    Route::get('/detailGajiGuru/{id}', [GajiController::class, 'detailGajiGuru']);
    Route::get('/bayarGajiGuru/{id}', [GajiController::class, 'bayarGajiGuru']);
    Route::put('/bayarGuru/{id}', [GajiController::class, 'bayarGuru']);
    Route::get('/downloadGajiGuru/{id}', [GajiController::class, 'downloadGajiGuru']);
    Route::delete('/hapusGajiGuru/{id}', [GajiController::class, 'hapusGajiGuru']);

    //Setting
    Route::get('/setting', [SettingController::class, 'index']);
    Route::get('/editSetting/{id}', [SettingController::class, 'editSetting']);
    Route::put('/updateSetting/{id}', [SettingController::class, 'updateSetting']);

    //Dokumen Pegawai
    Route::get('/dokumen', [DokumenController::class, 'index']);
    Route::get('/dokumenTabel', [DokumenController::class, 'dokumenTabel']);
    Route::get('/tambahDokumen', [DokumenController::class, 'tambahDokumen']);
    Route::post('/simpanDokumen', [DokumenController::class, 'simpanDokumen']);
    Route::get('/allDokumen/{id}', [DokumenController::class, 'allDokumen']);
    Route::get('/downloadDokumen/{folder}/{nama_file}', [DokumenController::class, 'downloadFile']);
    Route::get('/hapusFile/{id}', [DokumenController::class, 'hapusFile']);
    Route::get('/cariDokTabel', [DokumenController::class, 'cariDokTabel']);
    Route::get('/cariDokList', [DokumenController::class, 'cariDokList']);

    //Dokumen Siswa
    Route::get('/dokSiswa', [DokumenSiswaController::class, 'index']);
    Route::get('/dokTabelSiswa', [DokumenSiswaController::class, 'dokTabelSiswa']);
    Route::get('/tambahDokSiswa', [DokumenSiswaController::class, 'tambahDokSiswa']);
    Route::post('/simpanDokSiswa', [DokumenSiswaController::class, 'simpanDokSiswa']);
    Route::delete('/hapusDokumenSiswa/{id}', [DokumenSiswaController::class, 'hapusDokumenSiswa']);

    //Dokumen Manager
    Route::get('/dokumenManager', [DokumenController::class, 'dokumenManager']);
    Route::get('/dokManagerSiswa', [DokumenController::class, 'dokManagerSiswa']);
    Route::get('/cariDokManager', [DokumenController::class, 'cariDokManager']);
    Route::get('/editDokumen/{id}', [DokumenController::class, 'editDokumen']);
    Route::put('/updateDokumen/{id}', [DokumenController::class, 'updateDokumen']);
    Route::delete('/hapusDokumen/{id}', [DokumenController::class, 'hapusDokumen']);

    //Presensi
    Route::get('/data-presensi', [PresensiController::class, 'dataPresensi']);
    Route::get('/izinPegawai', [PresensiController::class, 'izinPegawai']);
    Route::put('/terimaIzin/{id}', [PresensiController::class, 'terimaIzin']);
    Route::put('/tolakIzin/{id}', [PresensiController::class, 'tolakIzin']);
    Route::get('/downloadBukti/{bukti}', [PresensiController::class, 'downloadBukti']);
    Route::get('/rekapPresensiAdmin', [PresensiController::class, 'rekapPresensiAdmin']);
    Route::get('/rekapPresensiHarian', [PresensiController::class, 'rekapPresensiHarian']);
    Route::get('/cariPresensiHarian', [PresensiController::class, 'cariPresensiHarian']);
    Route::get('/cariPresensiBulan', [PresensiController::class, 'cariPresensiBulan']);
    Route::get('/rekapIzin', [PresensiController::class, 'rekapIzin']);
    Route::get('/bulanIzin', [PresensiController::class, 'bulanIzin']);
    Route::get('/detailPresensiPegawai/{id}', [PresensiController::class, 'detailPresensiPegawai']);
    Route::get('/presensiPegawaiBulan/{id}', [PresensiController::class, 'presensiPegawaiBulan']);
    Route::post('/alphaPegawai/{id}', [PresensiController::class, 'alphaPegawai']);

    //Cuti
    Route::get('/dataCuti', [CutiController::class, 'dataCuti']);
    Route::put('/terimaCuti/{id}', [CutiController::class, 'terimaCuti']);
    Route::put('/tolakCuti/{id}', [CutiController::class, 'tolakCuti']);
    Route::get('/downloadSurat/{id}', [CutiController::class, 'downloadSurat']);
    Route::get('/downloadBuktiCuti/{bukti_cuti}', [CutiController::class, 'downloadBuktiCuti']);

    //Siswa
    Route::get('/dataSiswa', [SiswaController::class, 'index']);
    Route::get('/detailSiswa/{id}', [SiswaController::class, 'detailSiswa']);
    Route::post('/tambahSiswa', [SiswaController::class, 'tambahSiswa']);
    Route::get('/cariSiswa', [SiswaController::class, 'cariSiswa']);
    Route::get('/editSiswa/{id}', [SiswaController::class, 'editSiswa']);
    Route::put('/updateDataSiswa/{id}', [SiswaController::class, 'updateDataSiswa']);

    //Angkatan
    Route::get('/angkatan', [SiswaController::class, 'angkatan']);
    Route::post('/tambahAngkatan', [SiswaController::class, 'tambahAngkatan']);

    //Kelas
    Route::get('/dataKelas', [KelasController::class, 'index']);
    Route::post('/tambahKelas', [KelasController::class, 'tambahKelas']);

    //Tunjangan
    Route::get('/tunjangan', [TunjanganController::class, 'index']);
    Route::get('/editTunjangan/{id}', [TunjanganController::class, 'editTunjangan']);
    Route::put('/updateTunjangan/{id}', [TunjanganController::class, 'updateTunjangan']);

    //Guru ASN
    Route::get('/guruASN', [AsnController::class, 'guruASN']);
    Route::get('/editASN/{id}', [AsnController::class, 'editASN']);
    Route::post('/tambahGajiASN', [AsnController::class, 'tambahGajiASN']);
    Route::put('/updateGajiASN/{id}', [AsnController::class, 'updateGajiASN']);
    Route::get('/dataGuruASN', [AsnController::class, 'dataASN']);
    Route::post('/tambahGuruASN', [AsnController::class, 'tambahGuruASN']);
    Route::get('/inputGajiPNS/{id}', [AsnController::class, 'inputGajiPNS']);
    Route::post('/simpanGajiPNS', [AsnController::class, 'simpanGajiPNS']);
    Route::delete('/hapusGuruPNS/{id}', [AsnController::class, 'hapusGuruPNS']);
    Route::get('/editGuruPNS/{id}', [AsnController::class, 'editGuruPNS']);
    Route::put('/updateGuruPNS/{id}', [AsnController::class, 'updateGuruPNS']);

    //Guru PPPK
    Route::get('/guruPPPK', [PppkController::class, 'guruPPPK']);
    Route::get('/editPPPK/{id}', [PppkController::class, 'editPPPK']);
    Route::post('/tambahGajiPPPK', [PppkController::class, 'tambahGajiPPPK']);
    Route::put('/updateGajiPPPK/{id}', [PppkController::class, 'updateGajiPPPK']);
    Route::get('/dataGuruPPPK', [PppkController::class, 'dataPPPK']);
    Route::post('/tambahGuruPPPK', [PppkController::class, 'tambahGuruPPPK']);
    Route::get('/inputGajiPPPK/{id}', [PppkController::class, 'inputGajiPPPK']);
    Route::post('/simpanGajiPPPK', [PppkController::class, 'simpanGajiPPPK']);
    Route::delete('/hapusGuruPPPK/{id}', [PppkController::class, 'hapusGuruPPPK']);
    Route::get('/editGuruPPPK/{id}', [PppkController::class, 'editGuruPPPK']);
    Route::put('/updateGuruPPPK/{id}', [PppkController::class, 'updateGuruPPPK']);

    //Guru Honorer
    Route::get('/dataGuruHonorer', [GuruController::class, 'dataHonorer']);
    Route::post('/tambahGajiHonorer', [GuruController::class, 'tambahGajiHonorer']);
    Route::get('/inputGajiHonorer/{id}', [GuruController::class, 'inputGajiHonorer']);
    Route::post('/simpanGajiHonorer', [GuruController::class, 'simpanGajiHonorer']);
    Route::delete('/hapusGuruHonorer/{id}', [GuruController::class, 'hapusGuruHonorer']);
    Route::get('/editGuruHonorer/{id}', [GuruController::class, 'editGuruHonorer']);
    Route::put('/updateGuruHonorer/{id}', [GuruController::class, 'updateGuruHonorer']);

    //Bukan Guru
    Route::get('/dataPegawaiSekolah', [GuruController::class, 'dataPegawai']);
    Route::post('/tambahGajiPegawaiSekolah', [GuruController::class, 'tambahGajiPegawaiSekolah']);
    Route::get('/inputGajiPegawai/{id}', [GuruController::class, 'inputGajiPegawai']);
    Route::post('/simpanGajiPegawai', [GuruController::class, 'simpanGajiPegawai']);
    Route::get('/editPegawaiSekolah/{id}', [GuruController::class, 'editPegawaiSekolah']);
    Route::put('/updatePegawaiSekolah/{id}', [GuruController::class, 'updatePegawaiSekolah']);
    Route::delete('/hapusPegawaiSekolah/{id}', [GuruController::class, 'hapusPegawaiSekolah']);
});


Route::group(['middleware' => ['is_verify_email', 'role:Pegawai']], function () {
    Route::get('/profilePegawai', [DataDiriController::class, 'profilePegawai']);
    Route::get('/editPegawai/{id}', [UserController::class, 'editPegawai']);
    Route::put('/updatePegawai/{id}', [UserController::class, 'updatePegawai']);
    Route::get('/data-diri', [DataDiriController::class, 'index']);
    Route::get('/infoUtama/{id}', [DataDiriController::class, 'infoUtama']);
    Route::put('/updateInfoUtama/{id}', [DataDiriController::class, 'updateInfoUtama']);
    Route::get('/dataPendukung/{id}', [DataDiriController::class, 'dataPendukung']);
    Route::put('/updateDataPendukung/{id}', [DataDiriController::class, 'updateDataPendukung']);
    Route::get('/data-keluarga', [KeluargaController::class, 'index']);
    Route::get('/ortu', [KeluargaController::class, 'ortu']);
    Route::get('/pasangan', [KeluargaController::class, 'pasangan']);
    Route::get('/anak', [KeluargaController::class, 'anak']);

    //Ortu
    Route::get('/detailOrtu/{id}', [KeluargaController::class, 'detailOrtu']);
    Route::get('/tambahOrtu', [KeluargaController::class, 'tambahOrtu']);
    Route::post('/simpanOrtu', [KeluargaController::class, 'simpanOrtu']);
    Route::get('/editOrtu/{id}', [KeluargaController::class, 'editOrtu']);
    Route::put('/updateOrtu/{id}', [KeluargaController::class, 'updateOrtu']);
    Route::delete('/hapusOrtu/{id}', [KeluargaController::class, 'hapusOrtu']);

    //Pasangan
    Route::get('/detailPasangan/{id}', [KeluargaController::class, 'detailPasangan']);
    Route::get('/tambahPasangan', [KeluargaController::class, 'tambahPasangan']);
    Route::post('/simpanPasangan', [KeluargaController::class, 'simpanPasangan']);
    Route::get('/editPasangan/{id}', [KeluargaController::class, 'editPasangan']);
    Route::put('/updatePasangan/{id}', [KeluargaController::class, 'updatePasangan']);
    Route::delete('/hapusPasangan/{id}', [KeluargaController::class, 'hapusPasangan']);

    //Anak
    Route::get('/detailAnak/{id}', [KeluargaController::class, 'detailAnak']);
    Route::get('/tambahAnak', [KeluargaController::class, 'tambahAnak']);
    Route::post('/simpanAnak', [KeluargaController::class, 'simpanAnak']);
    Route::get('/editAnak/{id}', [KeluargaController::class, 'editAnak']);
    Route::put('/updateAnak/{id}', [KeluargaController::class, 'updateAnak']);
    Route::delete('/hapusAnak/{id}', [KeluargaController::class, 'hapusAnak']);

    //Pendidikan
    Route::get('/pendidikan', [PendidikanController::class, 'index']);
    Route::get('/tambahPendidikan', [PendidikanController::class, 'tambahPendidikan']);
    Route::post('/simpanPendidikan', [PendidikanController::class, 'simpanPendidikan']);
    Route::get('/detailPendidikan/{id}', [PendidikanController::class, 'detailPendidikan']);
    Route::get('/editPendidikan/{id}', [PendidikanController::class, 'editPendidikan']);
    Route::put('/updatePendidikan/{id}', [PendidikanController::class, 'updatePendidikan']);

    //Absensi
    Route::get('/absensi-pegawai', [AbsensiController::class, 'absensiPegawai']);
    Route::get('/rekap-absenPegawai', [AbsensiController::class, 'rekapAbsenPegawai']);
    Route::get('/absen/{id}', [AbsensiController::class, 'absenPegawai']);
    Route::put('/simpanAbsen/{id}', [AbsensiController::class, 'simpanAbsen']);
    Route::get('/detailAbsen/{id}', [AbsensiController::class, 'detailAbsen']);

    //Gaji
    Route::get('/gajiUserPegawai', [GajiController::class, 'gajiUserPegawai']);
    Route::get('/detailGaji/{id}', [GajiController::class, 'slipPegawai']);
    Route::get('/downloadGajiUserPegawai/{id}', [GajiController::class, 'downloadGajiPegawai']);

    //Dokumen
    Route::get('/dokumenPegawai', [DokumenController::class, 'dokumenPegawai']);
    Route::get('/detailDokumen/{id}', [DokumenController::class, 'detailDokumen']);
    Route::post('/uploadDokumen', [DokumenController::class, 'uploadDokumen']);
    Route::get('/downloadFile/{folder}/{nama_file}', [DokumenController::class, 'downloadFile']);
    Route::get('/editFile/{id}', [DokumenController::class, 'EditFile']);
    Route::put('/updateFile/{id}', [DokumenController::class, 'updateFile']);
    Route::get('/dokumenTabelPegawai', [DokumenController::class, 'dokumenTabelPegawai']);
    Route::get('/cariDokTabelPegawai', [DokumenController::class, 'cariDokTabelPegawai']);
    Route::get('/cariDokListPegawai', [DokumenController::class, 'cariDokListPegawai']);

    //Organisasi
    Route::get('/riwayatorganisasi', [OrganisasiController::class, 'index']);
    Route::get('/tambahOrganisasi', [OrganisasiController::class, 'tambahOrganisasi']);
    Route::post('/simpanOrganisasi', [OrganisasiController::class, 'simpanOrganisasi']);
    Route::get('/detailOrganisasi/{id}', [OrganisasiController::class, 'detailOrganisasi']);
    Route::get('/editOrganisasi/{id}', [OrganisasiController::class, 'editOrganisasi']);
    Route::put('/updateOrganisasi/{id}', [OrganisasiController::class, 'updateOrganisasi']);
    Route::delete('/hapusOrganisasi/{id}', [OrganisasiController::class, 'hapusOrganisasi']);

    //Seminar
    Route::get('/seminar', [SeminarController::class, 'index']);
    Route::get('/tambahSeminar', [SeminarController::class, 'tambahSeminar']);
    Route::post('/simpanSeminar', [SeminarController::class, 'simpanSeminar']);
    Route::get('/detailSeminar/{id}', [SeminarController::class, 'detailSeminar']);
    Route::get('/editSeminar/{id}', [SeminarController::class, 'editSeminar']);
    Route::put('/updateSeminar/{id}', [SeminarController::class, 'updateSeminar']);
    Route::delete('/hapusSeminar/{id}', [SeminarController::class, 'hapusSeminar']);

    //Diklat
    Route::get('/diklat', [DiklatController::class, 'index']);
    Route::get('/tambahDiklat', [DiklatController::class, 'tambahDiklat']);
    Route::post('/simpanDiklat', [DiklatController::class, 'simpanDiklat']);
    Route::get('/detailDiklat/{id}', [DiklatController::class, 'detailDiklat']);
    Route::get('/editDiklat/{id}', [DiklatController::class, 'editDiklat']);
    Route::put('/updateDiklat/{id}', [DiklatController::class, 'updateDiklat']);
    Route::delete('/hapusDiklat/{id}', [DiklatController::class, 'hapusDiklat']);


    //Presensi
    Route::get('/presensi', [PresensiController::class, 'index']);
    Route::get('/presensiBulan', [PresensiController::class, 'presensiBulan']);
    Route::post('/presensi', [PresensiController::class, 'inputPresensi']);
    Route::get('/ijin', [PresensiController::class, 'izin']);
    Route::post('/inputIzin', [PresensiController::class, 'inputIzin']);
    Route::get('/rekapPresensi', [PresensiController::class, 'rekapPresensi']);

    //Cuti
    Route::get('/cutiPegawai', [CutiController::class, 'cuti']);
    Route::get('/tambahCuti', [CutiController::class, 'tambahCuti']);
    Route::post('/simpanCuti', [CutiController::class, 'simpanCuti']);
    Route::get('/editCuti/{id}', [CutiController::class, 'editCuti']);
    Route::put('/updateCuti/{id}', [CutiController::class, 'updateCuti']);
    Route::delete('/hapusCuti/{id}', [CutiController::class, 'hapusCuti']);
    Route::get('/unduhSurat/{id}', [CutiController::class, 'downloadSuratPegawai']);
});

Route::group(['middleware' => ['is_verify_email', 'role:Siswa']], function () {

    //Profile Siswa
    Route::get('/profileSiswa', [SiswaController::class, 'profileSiswa']);
    Route::get('/editProfileSiswa/{id}', [SiswaController::class, 'editProfileSiswa']);
    Route::put('/updateProfileSiswa/{id}', [SiswaController::class, 'updateProfileSiswa']);

    Route::get('/dokumenSiswa', [DokumenSiswaController::class, 'dokumenSiswa']);
    Route::get('/detailDokumenSiswa/{id}', [DokumenSiswaController::class, 'detailDokumenSiswa']);
    Route::get('/editFileSiswa/{id}', [DokumenSiswaController::class, 'editFileSiswa']);
    Route::post('/uploadDokumenSiswa', [DokumenSiswaController::class, 'uploadDokumenSiswa']);
    Route::put('/updateFileSiswa/{id}', [DokumenSiswaController::class, 'updateFileSiswa']);
    Route::get('/fileManagerSiswa', [DokumenSiswaController::class, 'fileManagerSiswa']);
    Route::get('/downloadFileSiswa/{folder}/{nama_file}', [DokumenController::class, 'downloadFile']);
});
