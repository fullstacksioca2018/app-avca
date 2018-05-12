<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->increments('id');
            $table->float('distancia');
            $table->string('sigla',20)->nullable();
            $table->time('duracion');
            $table->float('tarifa_vuelo');
            $table->integer('origen_id')->unsigned();
            $table->integer('destino_id')->unsigned();
            $table->enum('estado',['activo','inactivo'])->nullable();
            $table->timestamps();

            /*
            |=================
            |Llaves Foraneas |
            |=================
            */

            $table->foreign('origen_id')->references('sucursal_id')->on('sucursales')->onDelete('cascade');
            $table->foreign('destino_id')->references('sucursal_id')->on('sucursales')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rutas');
    }
}
