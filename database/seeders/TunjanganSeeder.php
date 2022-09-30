<?php

namespace Database\Seeders;

use App\Models\Tunjangan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TunjanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tunjangan::create([
            'user_id' => 2,
            'sekolah_id' => 1,
            'tunjangan_pasangan' => "100000",
            'tunjangan_anak' => "50000",
            'tunjangan_pangan' => "10000",
            // 'pegawai_id' => 1,
            // 'total_tunjangan' => 300000,
            // 'tanggal_penggajian' => Carbon::now(),
            // 'is_active' => 1
        ]);
    }
}
