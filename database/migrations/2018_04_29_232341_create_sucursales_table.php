<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->increments('sucursal_id');

            $table->enum('tipo_sucursal', ['administrativa', 'operativa'])->nullable();
            $table->string('nombre', 255)->nullable();


            
            $table->enum('estatus', ['activa', 'inactiva'])->nullable();
            $table->string('sigla',20)->nullable();

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
        Schema::dropIfExists('sucursales');
    }
}
