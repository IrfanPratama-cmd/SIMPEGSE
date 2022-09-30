<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxGuruHonorer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_guru_honorer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id');
            $table->foreignId('pegawai_id');
            $table->string('gaji_pokok')->nullable();
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
        Schema::dropIfExists('trx_guru_honorer');
    }
}
