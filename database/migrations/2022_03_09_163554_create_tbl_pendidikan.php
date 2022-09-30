<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPendidikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pegawai_id');
            // $table->string('jenjang_pendidikan');
            $table->enum('jenjang_pendidikan', ['TK', 'SD', 'SMP', 'SMA', 'SMK', 'D-3', 'S-1', 'S-2', 'S-3']);
            $table->string('nama_instansi');
            $table->string('prodi')->nullable();
            $table->string('tahun_masuk');
            $table->string('tahun_lulus');
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
        Schema::dropIfExists('tbl_pendidikan');
    }
}
