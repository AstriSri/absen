<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSipBiodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_biodata', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable();
            $table->foreign('user')
                ->references('username')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nomorktp')->nullable();
            $table->unsignedBigInteger('jeniskelamin')->nullable();
            $table->foreign('jeniskelamin')
                ->references('id')
                ->on('sip_jeniskelamin')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('goldar')->nullable();
            $table->foreign('goldar')
                ->references('id')
                ->on('sip_golongandarah')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('agama')->nullable();
            $table->foreign('agama')
                ->references('id')
                ->on('sip_agama')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('kewarganegaraan')->nullable();
            $table->foreign('kewarganegaraan')
                ->references('id')
                ->on('sip_kewarganegaraan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('tempatlahir')->nullable();
            $table->date('tanggallahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kodepos')->nullable();
            $table->string('notelprumah')->nullable();
            $table->string('nohp')->nullable();
            $table->string('npwp')->nullable();
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
        Schema::dropIfExists('sip_biodata');
    }
}
