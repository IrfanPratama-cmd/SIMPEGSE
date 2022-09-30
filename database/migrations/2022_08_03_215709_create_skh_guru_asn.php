<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkhGuruAsn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skh_guru_asn', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id');
            $table->foreignId('asn_id');
            $table->string('gaji_asn');
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
        Schema::dropIfExists('skh_guru_asn');
    }
}
