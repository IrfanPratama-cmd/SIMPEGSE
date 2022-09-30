<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAbsensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('absensi_id')->references('id')->on('tm_absensi')->onDelete('cascade');
            $table->foreignId('user_id')->nullable();
            $table->foreignId('pegawai_id')->nullable();
            $table->time('jam_absen')->nullable();
            $table->enum('keterangan', ['Hadir', 'Sakit', 'Ijin', 'Alpha', 'Belum Absen']);
            $table->string('alasan')->nullable();
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
        Schema::dropIfExists('tbl_absensi');
    }
}
