<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siswa::create([
            'sekolah_id' => 1,
            'angkatan_id' => 1,
            'user_id' => 13,
            'nama_siswa' => "Siswa Pertama",
            'nis' => "12242156",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
        ]);

        Siswa::create([
            'sekolah_id' => 1,
            'angkatan_id' => 1,
            'user_id' => 14,
            'nama_siswa' => "Siswa Baik",
            'nis' => "12242156",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
        ]);

        Siswa::create([
            'sekolah_id' => 1,
            'angkatan_id' => 1,
            'user_id' => 15,
            'nama_siswa' => "Siswa Jahat",
            'nis' => "12242156",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
        ]);

        Siswa::create([
            'sekolah_id' => 1,
            'angkatan_id' => 2,
            'user_id' => 16,
            'nama_siswa' => "Siswa Jelek",
            'nis' => "12242156",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
        ]);

        Siswa::create([
            'sekolah_id' => 1,
            'angkatan_id' => 2,
            'user_id' => 17,
            'nama_siswa' => "Siswa 1",
            'nis' => "12242156",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
        ]);

        Siswa::create([
            'sekolah_id' => 1,
            'angkatan_id' => 2,
            'user_id' => 18,
            'nama_siswa' => "Siswa 2",
            'nis' => "12242156",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
        ]);

        Siswa::create([
            'sekolah_id' => 1,
            'angkatan_id' => 2,
            'user_id' => 19,
            'nama_siswa' => "Siswa 3",
            'nis' => "12242156",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
        ]);


        Siswa::create([
            'sekolah_id' => 1,
            'angkatan_id' => 2,
            'user_id' => 20,
            'nama_siswa' => "Siswa 4",
            'nis' => "12242156",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
        ]);

        Siswa::create([
            'sekolah_id' => 1,
            'angkatan_id' => 1,
            'user_id' => 21,
            'nama_siswa' => "Siswa 5",
            'nis' => "12242156",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
        ]);


        Siswa::create([
            'sekolah_id' => 1,
            'angkatan_id' => 1,
            'user_id' => 22,
            'nama_siswa' => "Siswa 6",
            'nis' => "12242156",
            'agama' => "Islam",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
        ]);
    }
}
