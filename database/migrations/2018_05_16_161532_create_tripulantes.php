<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripulantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tripulantes', function (Blueprint $table) {
            $table->increments('id');
            
            $table->enum('rango', ['piloto', 'copiloto', 'jefe de cabina', 'sobrecargo'])->nullable();	
            $table->string('licencia',255);
            $table->integer('personal_id')->unsigned();
            $table->foreign('personal_id')->references('id')->on('empleados')->onDelete('cascade');
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
        //
    }
}
