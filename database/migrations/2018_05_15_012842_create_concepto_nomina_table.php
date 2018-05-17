<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptoNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepto_nomina', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('concepto_id')->unsigned();
            $table->integer('nomina_id')->unsigned();

            $table->foreign('concepto_id')->references('concepto_id')->on('conceptos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nomina_id')->references('nomina_id')->on('nominas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('concepto_nomina');
    }
}
