<?php

namespace Database\Seeders;

use App\Models\GuruMapel;
use App\Models\TMMapel;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TMMapel::create([
            'sekolah_id' => 1,
            'nama_mapel' => "Matematika",
            // 'gaji' => 1500000,
        ]);

        TMMapel::create([
            'sekolah_id' => 1,
            'nama_mapel' => "Biologi",
            // 'gaji' => 1500000,
        ]);

        TMMapel::create([
            'sekolah_id' => 1,
            'nama_mapel' => "Fisika",
            // 'gaji' => 1500000,
        ]);

        TMMapel::create([
            'sekolah_id' => 1,
            'nama_mapel' => "Kimia",
            // 'gaji' => 1500000,
        ]);

        GuruMapel::create([
            'sekolah_id' => 1,
            'pegawai_id' => 1,
            'mapel_id' => 1,
        ]);
    }
}
