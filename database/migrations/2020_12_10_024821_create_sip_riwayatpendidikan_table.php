<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSipRiwayatpendidikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_riwayatpendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable();
            $table->foreign('user')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('pendidikan')->nullable();
            $table->foreign('pendidikan')->references('id')->on('sip_pendidikan')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('tahunlulus')->nullable();
            $table->string('namasekolah')->nullable();
            $table->string('noijazah')->nullable();
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
        Schema::dropIfExists('sip_riwayatpendidikan');
    }
}
