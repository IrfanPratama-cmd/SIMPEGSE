<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDokumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('sekolah_id');
            $table->foreignId('pegawai_id')->nullable();
            $table->foreignId('siswa_id')->nullable();
            $table->foreignId('dokumen_id');
            $table->string('nama_file');
            $table->string('tanggal_upload');
            $table->time('waktu_upload');
            $table->string('size');
            $table->string('extension');
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
        Schema::dropIfExists('tbl_dokumen');
    }
}
