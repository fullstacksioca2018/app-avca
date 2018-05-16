<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tripulantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tripulantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rango',255);
            $table->string('licencia',255);
            $table->integer('empleado_id')->unsigned();
            $table->foreign('empleado_id')->references('id')->on('empleados2')->onDelete('cascade');
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
        Schema::dropIfExists('tripulantes');
    }
}
