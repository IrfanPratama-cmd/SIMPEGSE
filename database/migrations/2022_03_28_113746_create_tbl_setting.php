<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_setting', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('sekolah_id')->nullable();
            $table->integer('cuti')->nullable();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_absen')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->string('kepala_sekolah')->nullable();
            $table->string('ttd_pimpinan')->nullable();
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
        Schema::dropIfExists('tbl_setting');
    }
}
