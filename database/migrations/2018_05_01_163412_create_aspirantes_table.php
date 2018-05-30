<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAspirantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aspirantes', function (Blueprint $table) {
            $table->increments('aspirante_id');
            $table->integer('cedula')->unique();
            $table->enum('nacionalidad', ['v', 'e']);
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['f', 'm']);
            $table->string('apellido',50);
            $table->string('nombre',50);
            $table->string('email',60)->unique();
            $table->string('telefono_movil',50);
            $table->string('telefono_fijo',50);
            $table->string('curriculum');
            $table->integer('vacante_id')->unsigned();
            $table->foreign('vacante_id')->references('vacante_id')->on('vacantes');
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
        Schema::dropIfExists('aspirantes');
    }
}
