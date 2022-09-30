<?php

namespace Database\Seeders;

use App\Models\Pendidikan;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pendidikan::create([
            'user_id' => 3,
            'pegawai_id' => 1,
            'jenjang_pendidikan' => "D-3",
            'nama_instansi' => "Universitas Sebelas Maret",
            'prodi' => "Teknik Informatika",
            'tahun_masuk' => "2019",
            'tahun_lulus' => "2022",
        ]);

        Pendidikan::create([
            'user_id' => 3,
            'pegawai_id' => 1,
            'jenjang_pendidikan' => "SMA",
            'nama_instansi' => "SMA Negeri 3 Surakarta",
            'tahun_masuk' => "2019",
            'tahun_lulus' => "2022",
        ]);
    }
}
