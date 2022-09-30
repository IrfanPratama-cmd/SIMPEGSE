<?php

namespace Database\Seeders;

use App\Models\Anak;
use App\Models\Ortu;
use App\Models\Pasangan;
use Illuminate\Database\Seeder;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ortu::create([
            'user_id' => 3,
            'pegawai_id' => 1,
            'nik' => "325462626",
            'nama_ortu' => "PAIJO TAIJO",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'jk' => "Laki-laki",
            'status' => "Hidup"
        ]);

        Ortu::create([
            'user_id' => 3,
            'pegawai_id' => 1,
            'nik' => "123456785",
            'nama_ortu' => "PAINEM SUKINEM",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'jk' => "Perempuan",
            'status' => "Hidup"
        ]);

        Pasangan::create([
            'user_id' => 3,
            'pegawai_id' => 1,
            'nik' => "325462626",
            'nama_pasangan' => "SUKIJAN PAIJAN",
            'status_pasangan' => "Istri",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0813335",
            'status' => "Menikah"
        ]);

        Anak::create([
            'user_id' => 3,
            'pegawai_id' => 1,
            'nik' => "325462626",
            'nama_anak' => "FERGUSO",
            'anak_nmr' => 1,
            'jk' => "Laki - laki",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0813335",
            'status' => "Hidup"
        ]);

        Anak::create([
            'user_id' => 3,
            'pegawai_id' => 1,
            'nik' => "325462626",
            'nama_anak' => "STEPHEN",
            'anak_nmr' => 2,
            'jk' => "Perempuan",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0813335",
            'status' => "Hidup"
        ]);
    }
}
