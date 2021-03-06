<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwBoletosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DwBoletos', function (Blueprint $table) {
            $table->increments('boleto_id');
            // $table->string('estado',10)->nullable();
            $table->integer('pasajero_id')->unsigned()->nullable();
            $table->integer('vuelo_id')->unsigned()->nullable();
            $table->integer('ingreso_id')->unsigned()->nullable();
            $table->timestamp('fecha_compra')->nullable();
            $table->timestamps();

            $table->foreign('pasajero_id')->references('pasajero_id')->on('dwpasajeros')->onDelete('cascade');
            $table->foreign('vuelo_id')->references('vuelo_id')->on('dwvuelos')->onDelete('cascade');
            $table->foreign('ingreso_id')->references('ingreso_id')->on('DwIngresos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DwBoletos');
    }
}
