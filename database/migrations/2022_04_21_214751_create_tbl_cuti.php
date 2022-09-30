<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCuti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cuti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('sekolah_id');
            $table->foreignId('pegawai_id');
            $table->string('jenis_cuti');
            $table->string('brp_hari');
            $table->string('alasan');
            $table->string('tgl_mulai');
            $table->string('tgl_selesai');
            $table->enum('status', ["Menunggu", "Disetujui", "Ditolak"]);
            $table->string('bukti_cuti');
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
        Schema::dropIfExists('tbl_cuti');
    }
}
