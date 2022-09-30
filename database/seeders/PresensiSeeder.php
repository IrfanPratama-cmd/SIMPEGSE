<?php

namespace Database\Seeders;

use App\Models\Presensi;
use Illuminate\Database\Seeder;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Senin, 25 April 2022",
            'jam_presensi' => "07:00:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Senin, 18 April 2022",
            'jam_presensi' => "07:00:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Senin, 11 April 2022",
            'jam_presensi' => "07:00:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Senin, 4 April 2022",
            'jam_presensi' => "07:00:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Selasa, 19 April 2022",
            'jam_presensi' => "07:10:00",
            'keterangan' => "Terlambat"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Selasa, 12 April 2022",
            'jam_presensi' => "07:10:00",
            'keterangan' => "Terlambat"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Selasa, 5 April 2022",
            'jam_presensi' => "07:10:00",
            'keterangan' => "Terlambat"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Selasa, 26 April 2022",
            'jam_presensi' => "07:10:00",
            'keterangan' => "Terlambat"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Rabu, 6 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Rabu, 13 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Rabu, 20 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Rabu, 27 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Kamis, 7 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Kamis, 14 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Kamis, 21 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Kamis, 28 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Jumat, 1 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Jumat, 8 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Jumat, 15 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Jumat, 22 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);

        Presensi::create([
            'user_id' => 2,
            'pegawai_id' => 1,
            'tgl' => "Jumat, 29 April 2022",
            'jam_presensi' => "06:40:00",
            'keterangan' => "Hadir"
        ]);
    }
}
