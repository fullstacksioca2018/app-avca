<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->increments('entrevista_id');
            $table->string('presentacion', 10);
            $table->string('inteligencia', 10);
            $table->string('formacion', 10);
            $table->string('experiencia', 10);
            $table->string('facilidad_expresion', 10);
            $table->string('habilidad', 10);
            $table->string('otros', 10);
            $table->string('observaciones');
            $table->unsignedInteger('aspirante_id');
            $table->foreign('aspirante_id')
                ->references('aspirante_id')
                ->on('aspirantes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('entrevistas');
    }
}
