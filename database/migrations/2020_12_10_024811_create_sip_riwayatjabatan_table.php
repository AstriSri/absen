<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSipRiwayatjabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_riwayatjabatan', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable();
            $table->foreign('user')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('jabatan')->nullable();
            $table->foreign('jabatan')->references('id')->on('sip_jabatan')->onDelete('cascade')->onUpdate('cascade');
            $table->string('no_sk')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->string('nama_ttd')->nullable();
            $table->string('tmt')->nullable();
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
        Schema::dropIfExists('sip_riwayatjabatan');
    }
}
