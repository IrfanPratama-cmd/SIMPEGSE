<?php

namespace Database\Seeders;

use App\Models\Divisi;
use App\Models\Instansi;
use App\Models\Ortu;
use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TrxUser;
use App\Models\Pengguna;
use App\Models\Sekolah;
use App\Models\Setting;
use App\Models\Siswa;
use Carbon\Carbon;
use DateTime;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => "Super Admin",
            'email' => "a@gmail.com",
            'role' => "Super Admin",
            'password' => bcrypt('aaa123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Admin Sekolah",
            'email' => "admin@gmail.com",
            'role' => "Admin",
            'password' => bcrypt('admin123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Irfan Pratama",
            'sekolah_id' => 1,
            'email' => "irfan@gmail.com",
            'role' => "Pegawai",
            'password' => bcrypt('irfan123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Irfanjay",
            'sekolah_id' => 1,
            'email' => "anjir@gmail.com",
            'role' => "Pegawai",
            'password' => bcrypt('anjir123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Paiman 1",
            'sekolah_id' => 1,
            'email' => "paiman@gmail.com",
            'role' => "Pegawai",
            'password' => bcrypt('123456'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Wagiman",
            'sekolah_id' => 1,
            'email' => "wagiman@gmail.com",
            'role' => "Pegawai",
            'password' => bcrypt('123456'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Sukijan",
            'sekolah_id' => 1,
            'email' => "sukijan@gmail.com",
            'role' => "Pegawai",
            'password' => bcrypt('123456'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Honorer 1",
            'sekolah_id' => 1,
            'email' => "h1@gmail.com",
            'role' => "Pegawai",
            'password' => bcrypt('123456'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Honorer 2",
            'sekolah_id' => 1,
            'email' => "h2@gmail.com",
            'role' => "Pegawai",
            'password' => bcrypt('123456'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Honorer 3",
            'sekolah_id' => 1,
            'email' => "h3@gmail.com",
            'role' => "Pegawai",
            'password' => bcrypt('123456'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Test 1",
            'sekolah_id' => 1,
            'email' => "t1@gmail.com",
            'role' => "Pegawai",
            'password' => bcrypt('123456'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Test 2",
            'sekolah_id' => 1,
            'email' => "t2@gmail.com",
            'role' => "Pegawai",
            'password' => bcrypt('123456'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Siswa 1",
            'sekolah_id' => 1,
            'email' => "siswa@gmail.com",
            'role' => "Siswa",
            'password' => bcrypt('siswa123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Siswa 2",
            'sekolah_id' => 1,
            'email' => "siswa2@gmail.com",
            'role' => "Siswa",
            'password' => bcrypt('siswa123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Siswa 3",
            'sekolah_id' => 1,
            'email' => "siswa3@gmail.com",
            'role' => "Siswa",
            'password' => bcrypt('siswa123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Siswa 4",
            'sekolah_id' => 1,
            'email' => "siswa4@gmail.com",
            'role' => "Siswa",
            'password' => bcrypt('siswa123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Siswa 5",
            'sekolah_id' => 1,
            'email' => "siswa5@gmail.com",
            'role' => "Siswa",
            'password' => bcrypt('siswa123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Siswa 6",
            'sekolah_id' => 1,
            'email' => "siswa6@gmail.com",
            'role' => "Siswa",
            'password' => bcrypt('siswa123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Siswa 7",
            'sekolah_id' => 1,
            'email' => "siswa7@gmail.com",
            'role' => "Siswa",
            'password' => bcrypt('siswa123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Siswa 8",
            'sekolah_id' => 1,
            'email' => "siswa8@gmail.com",
            'role' => "Siswa",
            'password' => bcrypt('siswa123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Siswa 9",
            'sekolah_id' => 1,
            'email' => "siswa9@gmail.com",
            'role' => "Siswa",
            'password' => bcrypt('siswa123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        User::create([
            'name' => "Siswa 10",
            'sekolah_id' => 1,
            'email' => "siswa10@gmail.com",
            'role' => "Siswa",
            'password' => bcrypt('siswa123'),
            'email_verified_at' => date(now()),
            'created_at' => new \DateTime,
            'is_email_verified' => 1
        ]);

        // Pegawai




        //Siswa


        Sekolah::create([
            'user_id' => 2,
            'nama_sekolah' => "SMA 1 Gemolong",
            'alamat' => "Gemolong, Sragen",
            'no_telp' => "0812121234",
        ]);

        Setting::create([
            'user_id' => 2,
            'sekolah_id' => 1,
            'cuti' => 22,
            'jam_masuk' => "07:00:01",
            'jam_absen' => "06:00:01",
            'jam_pulang' => "16:00:01",
            'kepala_sekolah' => "Sugiono Al-Thololi",
        ]);

        $this->call(KeluargaSeeder::class);
        $this->call(PendidikanSeeder::class);
        $this->call(JabatanSeeder::class);
        // $this->call(PresensiSeeder::class);
        $this->call(DokumenSeeder::class);
        $this->call(GajiSeeder::class);
        $this->call(MapelSeeder::class);
        $this->call(TunjanganSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(AngkatanSeeder::class);
        $this->call(AsnSeeder::class);
        $this->call(PppkSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(SiswaSeeder::class);
        // $this->call(Presensi2Seeder::class);
    }
}
