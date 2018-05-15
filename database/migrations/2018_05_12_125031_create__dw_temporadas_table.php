<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwTemporadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DwTemporadas', function (Blueprint $table) {
            $table->increments('temporada_id');
            $table->string('nombre',20)->nullable();
            $table->timestamp('inicio')->nullable();
            $table->timestamp('final')->nullable();
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
        Schema::dropIfExists('DwTemporadas');
    }
}
