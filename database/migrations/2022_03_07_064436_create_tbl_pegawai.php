<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('sekolah_id')->nullable();
            // $table->foreignId('jabatan_id')->nullable();
            $table->string('nip')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('no_bpjs')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('agama')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_rekening')->nullable();
            $table->text('alamat')->nullable();
            $table->string('jk')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_profile')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->nullable();
            $table->enum('golongan_guru', ['Guru PPPK', 'Guru PNS', 'Guru Honorer', 'Bukan Guru'])->nullable();
            // $table->dateTimeTz('tgl_masuk')->nullable();
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
        Schema::dropIfExists('tbl_pegawai');
    }
}
