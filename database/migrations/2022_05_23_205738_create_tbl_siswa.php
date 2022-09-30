<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('sekolah_id');
            $table->foreignId('angkatan_id');
            // $table->foreignId('kelas_id');
            // $table->integer('angkatan');
            $table->string('nama_siswa');
            $table->string('nis')->nullable();
            $table->string('agama')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('jk')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('status')->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto_profile')->nullable();
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
        Schema::dropIfExists('tbl_siswa');
    }
}
