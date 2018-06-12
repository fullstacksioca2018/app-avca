<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha')->nullable();
            $table->time('h_entrada')->nullable();
            $table->time('h_salida')->nullable();
            $table->boolean('dia_feriado')->nullable();
            $table->integer('h_extras_diurnas')->nullable();
            $table->integer('h_faltantes_diurnas')->nullable();
            $table->integer('h_extras_nocturnas')->nullable();
            $table->integer('h_faltantes_nocturnas')->nullable();
            $table->integer('h_extras_diurnas_feriado')->nullable();
            $table->integer('h_faltantes_diurnas_feriado')->nullable();
            $table->integer('h_extras_nocturnas_feriado')->nullable();
            $table->integer('h_faltantes_nocturnas_feriado')->nullable();
            $table->integer('empleado_id')->unsigned();

            $table->foreign('empleado_id')->references('empleado_id')->on('empleados');
            
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
        Schema::dropIfExists('asistencias');
    }
}
