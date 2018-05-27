<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_factura',20)->nullable();
            $table->date('fecha')->nullable();
            $table->float('importe_facturado');
            $table->string('numero_control',20)->nullable();
            $table->integer('adultos_cant')->nullable();
            $table->integer('ninos_cant')->nullable();
            $table->integer('NinosBrazos_cant')->nullable();
            $table->integer('tarjeta_id')->unsigned()->nullable();
            $table->timestamps();

            /*
            |=================
            |Llaves Foraneas |
            |=================
            */

            $table->foreign('tarjeta_id')->references('id')->on('tarjetas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
