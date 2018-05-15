<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwPasajerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DwPasajeros', function (Blueprint $table) {
            $table->increments('pasajero_id');
            $table->timestamp('fecha_nacimiento')->nullable();
            $table->string('genero', 10)->nullable();
            $table->string('discapacidad', 10)->nullable();
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
        Schema::dropIfExists('DwPasajeros');
    }
}
