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
            $table->enum('tipo_sucursal', ['administrativa', 'operativa']);
            $table->string('nombre', 255)->nullable();
            $table->enum('estatus', ['activa', 'inactiva']);
            $table->string('sigla',20)->nullable();
            $table->string('aeropuerto',100)->nullable();
            $table->string('direccion',100)->nullable();
            $table->string('estado',100)->nullable();
            $table->string('ciudad',100)->nullable();
            $table->string('pais',100)->nullable();
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
