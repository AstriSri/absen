<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSipAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_absensi', function (Blueprint $table) {
            $table->id();
            $table->string("user");
            $table->foreign('user')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->time('jam_datang');
            $table->time('jam_pulang');
            $table->time('jam_datang_jadwal');
            $table->time('jam_pulang_jadwal');
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
        Schema::dropIfExists('sip_absensi');
    }
}
