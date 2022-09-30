<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGajiPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gaji_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pegawai_id');
            $table->foreignId('sekolah_id');
            $table->foreignId('jabatan_id')->nullable();
            $table->string('tanggal_penggajian');
            $table->string('gaji_pokok');
            $table->string('total_gaji')->nullable();
            $table->enum('status', ['Dibayar', 'Belum Dibayar']);
            $table->integer('bulan');
            // $table->enum('is_active', ['1', '0']);
            $table->string('bukti_pembayaran')->nullable();
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
        Schema::dropIfExists('tbl_gaji_pegawai');
    }
}
