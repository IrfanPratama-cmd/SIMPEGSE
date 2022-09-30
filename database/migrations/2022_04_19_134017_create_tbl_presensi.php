<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPresensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_presensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('sekolah_id');
            $table->foreignId('pegawai_id');
            $table->string('tgl');
            $table->string('jam_presensi');
            $table->enum('keterangan', ['Hadir', 'Sakit', 'Izin', 'Alpha', 'Terlambat']);
            $table->string('countryName');
            $table->string('countryCode');
            $table->string('regionName');
            $table->string('cityName');
            $table->string('latitude');
            $table->string('longitude');
            $table->enum('status', ['Rumah', 'Sekolah', 'Alpha']);
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
        Schema::dropIfExists('tbl_presensi');
    }
}
