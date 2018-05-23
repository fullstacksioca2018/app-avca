<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwDemoradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DwDemorados', function (Blueprint $table) {
            $table->increments('demorado_id');
            $table->timestamp('salida')->nullable();
            $table->integer('vuelo_id')->unsigned()->nullable();
            $table->foreign('vuelo_id')->references('vuelo_id')->on('dwvuelos')->onDelete('cascade');
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
        Schema::dropIfExists('DwDemorados');
    }
}
