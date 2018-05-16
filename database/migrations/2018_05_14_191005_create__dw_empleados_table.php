<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DwEmpleados', function (Blueprint $table) {
            $table->increments('empleado_id');
            $table->string('estado',10)->nullable();
            $table->timestamp('fecha_contratacion')->nullable();
            $table->integer('cargo_id')->nullable();
            $table->integer('sucursal_id')->nullable();
            $table->timestamps();
            // $table->foreign('cargo_id')->references('cargo_id')->on('dwcargos')->onDelete('cascade');
            // $table->foreign('sucursal_id')->references('sucursal_id')->on('dwsucursales')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DwEmpleados');
    }
}
