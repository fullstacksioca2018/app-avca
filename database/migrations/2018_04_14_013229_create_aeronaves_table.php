<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAeronavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aeronaves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('capacidad_asientos');
            $table->string('modelo',20);
            $table->string('matricula',20);
            $table->enum('estado',['activo','inactivo','mantenimiento'])->default('activo');
            $table->dateTime('ultimo_mantenimiento');
            $table->integer('capacidad_equipaje');
            $table->integer('asiento_primera_clase');
            $table->integer('asiento_economicos');
            $table->integer('asiento_observacion');
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
        Schema::dropIfExists('aeronaves');
    }
}
