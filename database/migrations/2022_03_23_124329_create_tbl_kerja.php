<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kerja', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('pegawai_id');
            $table->string('jumlah_hari_kerja');
            $table->string('jumlah_hari_sakit');
            $table->string('jumlah_hari_izin');
            $table->string('jumlah_hari_alfa');
            $table->string('jumlah_hari_cuti');
            $table->string('potongan_gaji_pokok');
            $table->string('potongan_tunjangan_transport');
            $table->string('potongan_tunjangan_makanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kerja');
    }
}
