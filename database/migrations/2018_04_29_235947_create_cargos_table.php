<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->increments('cargo_id');
            $table->mediumText('titulo');
            $table->longText('perfil')->nullable();
            $table->integer('tabulador_salarial_id')->unsigned();
            $table->unsignedInteger('area_id');
            $table->foreign('tabulador_salarial_id')->references('tabulador_salarial_id')->on('tabuladores_salariales');
            $table->foreign('area_id')->references('area_id')->on('areas');
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
        Schema::dropIfExists('cargos');
    }
}
