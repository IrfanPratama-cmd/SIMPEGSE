<?php

namespace Database\Seeders;

use App\Models\Gaji;
use App\Models\GajiMapel;
use App\Models\GajiPegawai;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GajiPegawai::create([
            'sekolah_id' => 1,
            'user_id' => 3,
            'pegawai_id' => 1,
            'jabatan_id' => 3,
            'tanggal_penggajian' => Carbon::now(),
            'gaji_pokok' => 2000000,
            'status' => "Belum Dibayar",
            'bulan' => 06
        ]);

        GajiMapel::create([
            'sekolah_id' => 1,
            'user_id' => 3,
            'pegawai_id' => 1,
            'mapel_id' => 2,
            'tanggal_penggajian' => Carbon::now(),
            'gaji_pokok' => 2000000,
            'status' => "Belum Dibayar",
            'bulan' => 06
        ]);
    }
}
