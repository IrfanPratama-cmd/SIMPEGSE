<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\TMJabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TMJabatan::create([
            'sekolah_id' => 1,
            'nama_jabatan' => "Kepala Sekolah",
            'is_many' => "0"
            // 'gaji_pokok' => "3000000",
            // 'tunjangan_pasangan' => "100000",
            // 'tunjangan_anak' => "50000",
            // 'tunjangan_transport' => "10000",
        ]);

        TMJabatan::create([
            'sekolah_id' => 1,
            'nama_jabatan' => "Sie Kurikulum",
            'is_many' => "0"
            // 'gaji_pokok' => "3000000",
            // 'tunjangan_pasangan' => "100000",
            // 'tunjangan_anak' => "50000",
            // 'tunjangan_transport' => "10000",
        ]);

        TMJabatan::create([
            'sekolah_id' => 1,
            'nama_jabatan' => "Sie Kesiswaan",
            'is_many' => "0"
            // 'gaji_pokok' => "3000000",
            // 'tunjangan_pasangan' => "100000",
            // 'tunjangan_anak' => "50000",
            // 'tunjangan_transport' => "10000",
        ]);

        TMJabatan::create([
            'sekolah_id' => 1,
            'nama_jabatan' => "Guru",
            'is_many' => "1"
            // 'gaji_pokok' => "3000000",
            // 'tunjangan_pasangan' => "100000",
            // 'tunjangan_anak' => "50000",
            // 'tunjangan_transport' => "10000",
        ]);

        Jabatan::create([
            'sekolah_id' => 1,
            'pegawai_id' => 1,
            'jabatan_id' => 2
        ]);
    }
}
