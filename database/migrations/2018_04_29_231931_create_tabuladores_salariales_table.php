<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabuladoresSalarialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabuladores_salariales', function (Blueprint $table) {
            $table->increments('tabulador_salarial_id');
            $table->integer('cod_nivel')->unique();
            $table->string('nivel');
            $table->float('sueldo_base');
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
        Schema::dropIfExists('tabuladores_salariales');
    }
}
