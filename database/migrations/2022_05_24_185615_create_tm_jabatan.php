<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_jabatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id');
            $table->string('nama_jabatan');
            $table->enum('is_many', [1, 0])->nullable();
            // $table->string('gaji_pokok');
            // $table->string('tunjangan_pasangan');
            // $table->string('tunjangan_anak');
            // $table->string('tunjangan_transport');
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
        Schema::dropIfExists('tm_jabatan');
    }
}
