<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripulantesVuelo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tripulante_vuelo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tripulante_id')->unsigned()->nullable();
            $table->integer('vuelo_id')->unsigned()->nullable();

            $table->foreign('tripulante_id')->references('id')->on('tripulantes')->onDelete('cascade');

            $table->foreign('vuelo_id')->references('id')->on('vuelos')->onDelete('cascade');
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
        //
    }
}
