<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DwRutas', function (Blueprint $table) {
            $table->increments('ruta_id');
            $table->float('tarifa_vuelo')->unsigned();
            $table->integer('origen_id')->unsigned();
            $table->integer('destino_id')->unsigned();
            $table->timestamps();

            // $table->foreign('origen_id')->references('sucursal_id')->on('dwsucursales')->onDelete('cascade');
            // $table->foreign('destino_id')->references('sucursal_id')->on('dwsucursales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DwRutas');
    }
}
