<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->increments('expediente_id');
            $table->string('num_oficio')->unique()->nullable();
            $table->date('fecha');
            $table->enum('tipo_oficio', [
               'amonestaciones',
               'reconocimientos',
               'formacion',
               'nombramiento',
               'accidente laboral',
               'licencias',
               'reposos médicos',
               'postparto'
            ]);
            $table->longText('descripcion');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_final')->nullable();
            $table->string('soporte_pdf');
            $table->integer('empleado_id')->unsigned();
            $table->foreign('empleado_id')->references('empleado_id')->on('empleados');
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
        Schema::dropIfExists('expedientes');
    }
}
