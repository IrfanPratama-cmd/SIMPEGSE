<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRiwayatOrganisasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_riwayat_organisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pegawai_id');
            $table->string('nama_organisasi');
            $table->string('bidang_organisasi');
            $table->string('jabatan');
            $table->string('periode');
            $table->string('bukti_organisasi');
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
        Schema::dropIfExists('tbl_riwayat_organisasi');
    }
}
