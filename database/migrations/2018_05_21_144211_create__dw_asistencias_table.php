<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DwAsistencias', function (Blueprint $table) {
            $table->increments('asistencia_id');
            $table->float('porcentaje')->nullable();
            $table->integer('fecha_id')->nullable();
            $table->integer('empleado_id')->nullable();
            $table->timestamps();

            // $table->foreign('fecha_id')->references('fecha_id')->on('DwFechas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DwAsistencias');
    }
}
