<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptos', function (Blueprint $table) {
            $table->increments('concepto_id');
            $table->string('tipo_concepto');
            $table->string('descripcion',255);
            $table->float('porcentaje')->nullable();
            $table->double('valor_fijo')->nullable();            
            $table->boolean('bono_vacacional')->nullable();
            $table->boolean('utilidades')->nullable();
            $table->boolean('prestaciones')->nullable();
            $table->boolean('islr')->nullable();
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
        Schema::dropIfExists('conceptos');
    }
}
