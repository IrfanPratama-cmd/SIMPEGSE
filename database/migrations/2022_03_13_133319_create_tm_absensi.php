<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmAbsensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_absensi', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('divisi_id');
            $table->string('hari');
            $table->string('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_akhir');
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
        Schema::dropIfExists('tm_absensi');
    }
}
