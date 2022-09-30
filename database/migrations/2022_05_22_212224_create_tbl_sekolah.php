<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSekolah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sekolah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama_sekolah');
            $table->text('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('foto_sekolah')->nullable();
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
        Schema::dropIfExists('tbl_sekolah');
    }
}
