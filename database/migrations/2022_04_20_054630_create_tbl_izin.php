<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblIzin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_izin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id');
            $table->foreignId('user_id');
            $table->foreignId('pegawai_id');
            $table->foreignId('presensi_id');
            $table->string('tgl');
            $table->enum('keterangan', ['Sakit', 'Izin']);
            $table->string('alasan');
            $table->string('bukti');
            $table->enum('status', ['Menunggu', 'Ditolak', 'Diterima']);
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
        Schema::dropIfExists('tbl_izin');
    }
}
