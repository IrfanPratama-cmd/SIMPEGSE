<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxGuruAsn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_guru_asn', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id');
            $table->foreignId('skh_asn_id');
            $table->foreignId('pegawai_id');
            $table->string('golongan_asn')->nullable();
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
        Schema::dropIfExists('trx_guru_asn');
    }
}
