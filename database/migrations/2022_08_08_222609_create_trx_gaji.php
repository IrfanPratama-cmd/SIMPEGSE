<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_gaji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pegawai_id');
            $table->foreignId('sekolah_id');
            $table->string('tanggal_penggajian');
            $table->string('gaji_pokok');
            $table->string('tunjangan_pasangan')->nullable();
            $table->string('tunjangan_anak')->nullable();
            $table->string('tunjangan_pangan')->nullable();
            $table->string('total_gaji')->nullable();
            $table->enum('status', ['Dibayar', 'Belum Dibayar']);
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
        Schema::dropIfExists('trx_gaji');
    }
}
