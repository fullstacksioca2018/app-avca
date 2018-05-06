<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegmentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segmentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vuelo_id')->unsigned();
            $table->integer('aeronave_id')->unsigned();
            $table->integer('ruta_id')->unsigned();
            $table->timestamps();

        /*
        |=================
        |Llaves Foraneas |
        |=================
         */

        $table->foreign('vuelo_id')->references('id')->on('vuelos')->onDelete('cascade');
        $table->foreign('aeronave_id')->references('id')->on('aeronaves')->onDelete('cascade');
        $table->foreign('ruta_id')->references('id')->on('rutas')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('segmentos');
    }
}
