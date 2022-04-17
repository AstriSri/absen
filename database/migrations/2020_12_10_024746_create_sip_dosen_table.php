<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSipDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable();
            $table->foreign('user')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nidn')->nullable();
            $table->string('namagelar')->nullable();
            $table->unsignedBigInteger('statusdosen')->nullable();
            $table->foreign('statusdosen')->references('id')->on('sip_statusdosen')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('homebase')->nullable();
            $table->foreign('homebase')->references('id')->on('sip_dosen_homebase')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sip_dosen');
    }
}
