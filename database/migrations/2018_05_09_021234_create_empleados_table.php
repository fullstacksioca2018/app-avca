<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('empleado_id');
            $table->integer('cedula')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->enum('nacionalidad', ['v','e']);
            $table->date('fecha_nacimiento');
            $table->enum('estado_civil', ['solter@', 'casad@', 'divorciad@', 'viud@', 'concubin@']);
            $table->string('foto')->nullable();
            $table->enum('sexo', ['f', 'm']);
            $table->string('estado');
            $table->string('ciudad');
            $table->string('direccion');
            $table->string('telefono_fijo', 15);
            $table->string('telefono_movil', 15);
            $table->string('email', 60)->unique();
            $table->enum('tipo_discapacidad', ['trastorno del habla y lenguaje', 'visual', 'motriz', 'auditiva'])->nullable();
            $table->integer('sucursal')->unsigned();
            $table->integer('departamento')->unsigned();
            $table->integer('cargo')->unsigned();
            $table->enum('tipo_empleado', ['administrativo', 'operativo', 'tripulacion']);
            $table->enum('nivel_academico', ['bachiller', 'tsu', 'profesional', 'especialista 1', 'especialista 2']);
            $table->string('profesion');
            $table->enum('condicion_laboral', ['fijo', 'contratado', 'inactivo', 'suplente']);
            $table->enum('tipo_horario', ['fijo', 'rotativo']);
            $table->date('fecha_ingreso');
            $table->string('banco', 100);
            $table->bigInteger('cuenta_bancaria');
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
        Schema::dropIfExists('empleados');
    }
}
