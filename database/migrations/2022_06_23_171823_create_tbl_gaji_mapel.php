<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGajiMapel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gaji_mapel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pegawai_id');
            $table->foreignId('sekolah_id');
            $table->foreignId('mapel_id')->nullable();
            $table->string('tanggal_penggajian');
            $table->string('gaji_pokok');
            $table->string('total_gaji')->nullable();
            // $table->enum('is_active', ['1', '0']);
            $table->enum('status', ['Dibayar', 'Belum Dibayar']);
            $table->integer('bulan');
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
        Schema::dropIfExists('tbl_gaji_mapel');
    }
}
