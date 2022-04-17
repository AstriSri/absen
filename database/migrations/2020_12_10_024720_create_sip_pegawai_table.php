<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSipPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable();
            $table->foreign('user')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('namagelar')->nullable();
            $table->unsignedBigInteger('divisi')->nullable();
            $table->foreign('divisi')->references('id')->on('sip_divisi')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('statuskerja')->nullable();
            $table->foreign('statuskerja')->references('id')->on('sip_statuskerja')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('statuspegawai')->nullable();
            $table->foreign('statuspegawai')->references('id')->on('sip_statuspegawai')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sip_pegawai');
    }
}
