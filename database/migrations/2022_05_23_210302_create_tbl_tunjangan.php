<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTunjangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tunjangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('sekolah_id')->nullable();
            $table->string('tunjangan_pasangan')->nullable();
            $table->string('tunjangan_anak')->nullable();
            $table->string('tunjangan_pangan')->nullable();
            // $table->foreignId('pegawai_id');
            // $table->string('total_tunjangan');
            // $table->string('tanggal_penggajian');
            // $table->enum('is_active', ['1', '0']);
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
        Schema::dropIfExists('tbl_tunjangan');
    }
}
