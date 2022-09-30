<?php

namespace Database\Seeders;

use App\Models\Angkatan;
use Illuminate\Database\Seeder;

class AngkatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Angkatan::create([
            'sekolah_id' => 1,
            'angkatan' => 2018,
        ]);

        Angkatan::create([
            'sekolah_id' => 1,
            'angkatan' => 2019,
        ]);
    }
}
