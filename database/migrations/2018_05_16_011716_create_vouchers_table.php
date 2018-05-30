<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('voucher_id');

            $table->integer('empleado_id')->unsigned();
            $table->integer('concepto_id')->unsigned();
            $table->integer('nomina_id')->unsigned();

            $table->float('monto');
            $table->date('fecha');

            $table->foreign('empleado_id')->references('empleado_id')->on('empleados');
            $table->foreign('concepto_id')->references('concepto_id')->on('conceptos');
            $table->foreign('nomina_id')->references('nomina_id')->on('nominas');

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
        Schema::dropIfExists('vouchers');
    }
}
