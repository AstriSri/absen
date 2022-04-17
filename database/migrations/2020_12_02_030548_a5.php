<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class A5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a5', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user');
            $table->string('action')->nullable();
            $table->string('detail')->nullable();
            $table->string('target')->nullable();
            $table->text('history')->nullable();
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
        Schema::dropIfExists('a5');
    }
}
