<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPasangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pasangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pegawai_id');
            $table->string('nik');
            $table->string('nama_pasangan');
            $table->enum('status_pasangan', ['Suami', 'Istri'])->nullable();
            // $table->string('jk');
            $table->string('agama');
            $table->string('tgl_lahir');
            $table->string('no_telp');
            // $table->enum('status_kawin', ['Menikah', 'Cerai'])->nullable();
            $table->enum('status', ['Menikah', 'Cerai', 'Meninggal'])->nullable();
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
        Schema::dropIfExists('tbl_pasangan');
    }
}
