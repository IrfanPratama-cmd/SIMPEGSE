<?php

namespace Database\Seeders;

use App\Models\KategoriDokumen;
use App\Models\TMDokumen;
use Illuminate\Database\Seeder;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriDokumen::create([
            'kategori' => "Pegawai"
        ]);

        KategoriDokumen::create([
            'kategori' => "Siswa"
        ]);

        TMDokumen::create([
            'sekolah_id' => 1,
            // 'kategori_id' => 1,
            'nama_dokumen' => "Laporan Harian",
            'folder' => "Laporan Harian 1",
            'keterangan' => "Dikumpulkan Hari ini",
            'kategori' => "Pegawai",
            'tanggal' => "2022-04-01",
        ]);

        TMDokumen::create([
            'sekolah_id' => 1,
            // 'kategori_id' => 1,
            'nama_dokumen' => "Laporan Harian 2",
            'folder' => "Harian 2",
            'keterangan' => "Dikumpulkan Besok",
            'kategori' => "Pegawai",
            'tanggal' => "2022-04-02",
        ]);

        TMDokumen::create([
            'sekolah_id' => 1,
            'angkatan_id' => 1,
            'nama_dokumen' => "Raport Semester",
            'folder' => "Raport Semester",
            'keterangan' => "Dikumpulkan Bulan ini",
            'kategori' => "Siswa",
            'tanggal' => "2022-04-11",
        ]);
    }
}
