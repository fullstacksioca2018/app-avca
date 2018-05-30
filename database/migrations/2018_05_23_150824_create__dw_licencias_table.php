<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwLicenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DwLicencias', function (Blueprint $table) {
            $table->increments('lecencia_id');
            $table->float('porcentaje')->nullable();
            $table->integer('fecha_id')->unsigned()->nullable();
            $table->integer('empleado_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('fecha_id')->references('fecha_id')->on('dwfechas')->onDelete('cascade');
            $table->foreign('empleado_id')->references('empleado_id')->on('dwempleados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DwLicencias');
    }
}
