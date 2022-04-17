<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSipKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable();
            $table->foreign('user')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('anggotakeluarga')->nullable();
            $table->string('nama')->nullable();
            $table->string('nomorktp')->nullable();
            $table->string('jeniskelamin')->nullable();
            $table->string('tempatlahir')->nullable();
            $table->date('tanggallahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('jenispekerjaan')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sip_keluarga');
    }
}
