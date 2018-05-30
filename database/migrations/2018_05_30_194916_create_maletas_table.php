<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maletas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('boleto_id')->unsigned();
            $table->integer('cantidad')->nullable();
            $table->integer('peso')->nullable();
            $table->integer('sobrepeso')->nullable();
            $table->timestamps();
            $table->foreign('boleto_id')->references('id')->on('boletos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maletas');
    }
}
