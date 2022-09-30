<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'sekolah_id' => 1,
            'nama_kelas' => "X MIPA 1",
        ]);

        Kelas::create([
            'sekolah_id' => 1,
            'nama_kelas' => "X MIPA 2",
        ]);

        Kelas::create([
            'sekolah_id' => 1,
            'nama_kelas' => "X IPS 1",
        ]);
    }
}
