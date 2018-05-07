<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacantes', function (Blueprint $table) {
            $table->increments('vacante_id');
            $table->date('fecha_publicacion');
            $table->integer('sucursal_id')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->integer('cargo_id')->unsigned();
            $table->enum('estatus', ['activa', 'inactiva'])->default('activa');
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->foreign('area_id')->references('area_id')->on('areas');
            $table->foreign('cargo_id')->references('cargo_id')->on('cargos');
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
        Schema::dropIfExists('vacantes');
    }
}
