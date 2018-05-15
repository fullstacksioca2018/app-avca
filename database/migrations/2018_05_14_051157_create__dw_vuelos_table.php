<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DwVuelos', function (Blueprint $table) {
            $table->increments('vuelo_id');
            $table->integer('ruta_id');
            $table->string('estado',10)->nullable();
            $table->string('aerolinea',30)->nullable();
            $table->timestamp('fecha_creacion')->nullable();
            $table->timestamp('salida')->nullable();
            $table->timestamp('fecha_cambio_estado')->nullable();
            // $table->foreign('ruta_id')->references('ruta_id')->on('dwrutas');


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
        Schema::dropIfExists('DwVuelos');
    }
}
