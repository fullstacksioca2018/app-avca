<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_vuelo',20);
            $table->enum('estado',['abierto','cancelado','ejecutado','retrasado','cerrado'])->default('abierto');
            $table->datetime('fecha_salida');
            $table->integer('boletos_vendidos')->default('0');
            $table->integer('boletos_reservados')->default('0');
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
        Schema::dropIfExists('vuelos');
    }
}
