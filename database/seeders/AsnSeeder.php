<?php

namespace Database\Seeders;

use App\Models\GuruASN;
use Illuminate\Database\Seeder;

class AsnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GuruASN::create([
            'golongan_asn' => "Golongan IA"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IB"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IC"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan ID"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IIA"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IIB"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IIC"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IID"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IIIA"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IIIB"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IIIC"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IIID"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IVA"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IVB"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IVC"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IVD"
        ]);

        GuruASN::create([
            'golongan_asn' => "Golongan IVE"
        ]);
    }
}
