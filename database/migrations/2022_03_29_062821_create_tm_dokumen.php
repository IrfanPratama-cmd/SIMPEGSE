<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmDokumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id');
            $table->foreignId('angkatan_id')->nullable();
            $table->string('nama_dokumen');
            $table->string('folder');
            $table->text('keterangan');
            $table->enum('kategori', ["Pegawai", "Siswa"]);
            $table->string('tanggal');
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
        Schema::dropIfExists('tm_dokumen');
    }
}
