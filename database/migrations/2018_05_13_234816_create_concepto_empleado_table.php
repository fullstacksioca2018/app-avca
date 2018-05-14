<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptoEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepto_empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empleado_id')->unsigned();
            $table->integer('concepto_id')->unsigned();
            $table->foreign('empleado_id')->references('empleado_id')->on('empleados')->onDelete('cascade');
            $table->foreign('concepto_id')->references('concepto_id')->on('conceptos')->onDelete('cascade');
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
        Schema::dropIfExists('concepto_empleado');
    }
}
