<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Pegawai::create([
            'user_id' => 3,
            'sekolah_id' => 1,
            'nip' => "111112243",
            'nik' => "325462626",
            'no_kk' => "131352",
            'no_bpjs' => "323252",
            'no_npwp' => "333322",
            'agama' => "Islam",
            'nama_lengkap' => "Irfan Pratama",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'no_rekening' => "12213111410",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
            'golongan_guru' => "Guru PNS",
            'status' => "Aktif",
            // 'tgl_masuk' => new \DateTime,
            'created_at' => date_create('1988-08-10')
        ]);

        Pegawai::create([
            'user_id' => 4,
            'sekolah_id' => 1,
            'nip' => "111112243",
            'nik' => "325462626",
            'no_kk' => "131352",
            'no_bpjs' => "323252",
            'no_npwp' => "333322",
            'agama' => "Islam",
            'nama_lengkap' => "Irfanjay",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'no_rekening' => "122131114220",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
            'golongan_guru' => "Guru PPPK",
            'status' => "Aktif",
            // 'tgl_masuk' => new \DateTime,
            'created_at' => date_create('1988-08-10')
        ]);

        Pegawai::create([
            'user_id' => 5,
            'sekolah_id' => 1,
            'nip' => "111112243",
            'nik' => "325462626",
            'no_kk' => "131352",
            'no_bpjs' => "323252",
            'no_npwp' => "333322",
            'agama' => "Islam",
            'nama_lengkap' => "Paiman",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'no_rekening' => "12213111410",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
            'golongan_guru' => "Guru PNS",
            'status' => "Aktif",
            // 'tgl_masuk' => new \DateTime,
            'created_at' => date_create('1988-08-10')
        ]);

        Pegawai::create([
            'user_id' => 6,
            'sekolah_id' => 1,
            'nip' => "111112243",
            'nik' => "325462626",
            'no_kk' => "131352",
            'no_bpjs' => "323252",
            'no_npwp' => "333322",
            'agama' => "Islam",
            'nama_lengkap' => "Wagiman",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'no_rekening' => "12213111410",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
            'golongan_guru' => "Guru PNS",
            'status' => "Aktif",
            // 'tgl_masuk' => new \DateTime,
            'created_at' => date_create('1988-08-10')
        ]);

        Pegawai::create([
            'user_id' => 7,
            'sekolah_id' => 1,
            'nip' => "111112243",
            'nik' => "325462626",
            'no_kk' => "131352",
            'no_bpjs' => "323252",
            'no_npwp' => "333322",
            'agama' => "Islam",
            'nama_lengkap' => "Sukijan",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'no_rekening' => "122131114220",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
            'golongan_guru' => "Guru PPPK",
            'status' => "Aktif",
            // 'tgl_masuk' => new \DateTime,
            'created_at' => date_create('1988-08-10')
        ]);

        Pegawai::create([
            'user_id' => 8,
            'sekolah_id' => 1,
            'nip' => "111112243",
            'nik' => "325462626",
            'no_kk' => "131352",
            'no_bpjs' => "323252",
            'no_npwp' => "333322",
            'agama' => "Islam",
            'nama_lengkap' => "Paijo",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'no_rekening' => "122131114220",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
            'golongan_guru' => "Guru Honorer",
            'status' => "Aktif",
            // 'tgl_masuk' => new \DateTime,
            'created_at' => date_create('1988-08-10')
        ]);

        Pegawai::create([
            'user_id' => 9,
            'sekolah_id' => 1,
            'nip' => "111112243",
            'nik' => "325462626",
            'no_kk' => "131352",
            'no_bpjs' => "323252",
            'no_npwp' => "333322",
            'agama' => "Islam",
            'nama_lengkap' => "Wagiman",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'no_rekening' => "12213111410",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
            'golongan_guru' => "Guru Honorer",
            'status' => "Aktif",
            // 'tgl_masuk' => new \DateTime,
            'created_at' => date_create('1988-08-10')
        ]);

        Pegawai::create([
            'user_id' => 10,
            'sekolah_id' => 1,
            'nip' => "111112243",
            'nik' => "325462626",
            'no_kk' => "131352",
            'no_bpjs' => "323252",
            'no_npwp' => "333322",
            'agama' => "Islam",
            'nama_lengkap' => "Sukijan",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'no_rekening' => "122131114220",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
            'golongan_guru' => "Guru Honorer",
            'status' => "Aktif",
            // 'tgl_masuk' => new \DateTime,
            'created_at' => date_create('2010-08-10')
        ]);

        Pegawai::create([
            'user_id' => 12,
            'sekolah_id' => 1,
            'nip' => "111112243",
            'nik' => "325462626",
            'no_kk' => "131352",
            'no_bpjs' => "323252",
            'no_npwp' => "333322",
            'agama' => "Islam",
            'nama_lengkap' => "Test 1",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'no_rekening' => "12213111410",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
            'golongan_guru' => "Bukan Guru",
            'status' => "Aktif",
            // 'tgl_masuk' => new \DateTime,
            'created_at' => date_create('2010-08-10')
        ]);

        Pegawai::create([
            'user_id' => 13,
            'sekolah_id' => 1,
            'nip' => "111112243",
            'nik' => "325462626",
            'no_kk' => "131352",
            'no_bpjs' => "323252",
            'no_npwp' => "333322",
            'agama' => "Islam",
            'nama_lengkap' => "Test 2",
            'tgl_lahir' => date(now()),
            'no_telp' => "0811111111",
            'no_rekening' => "122131114220",
            'alamat' => "Gemolong, Sragen",
            'jk' => "Laki-laki",
            'golongan_guru' => "Bukan Guru",
            'status' => "Aktif",
            // 'tgl_masuk' => new \DateTime,
            'created_at' => date_create('2010-08-10')
        ]);
    }
}
