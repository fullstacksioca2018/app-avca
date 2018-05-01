<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',20);
            $table->string('apellido',100);
            $table->string('tipo_documento',50);
            $table->string('documento', 50);
            $table->string('codigo_postal',10);
            $table->string('direccion',100);
            $table->date('fecha_nacimiento');
            $table->string('genero',10);
            $table->string('telefono_fijo',11);
            $table->string('telefono_movil',11);
            $table->integer('user_id')->unsigned();
            $table->integer('pais_id')->unsigned();
            $table->timestamps();

             /*
            |=================
            |Llaves Foraneas |
            |=================
            */

            $table->foreign('pais_id')->references('id')->on('paises')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
