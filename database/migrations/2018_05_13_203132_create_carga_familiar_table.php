<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargaFamiliarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carga_familiar', function (Blueprint $table) {
            $table->increments('carga_familiar_id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula_beneficiario');
            $table->date('fecha_nacimiento');
            $table->boolean('estatus')->default(true);
            $table->enum('genero',['m','f']);
            $table->enum('parentesco', ['hijos', 'padres', 'conyugue']);
            $table->integer('empleado_id')->unsigned();

            $table->foreign('empleado_id')->references('empleado_id')->on('empleados')->onDelete('cascade');

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
        Schema::dropIfExists('carga_familiar');
    }
}
