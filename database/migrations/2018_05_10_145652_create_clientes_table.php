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
            $table->string('nombre',20)->nullable();
            $table->string('apellido',100)->nullable();
            $table->string('tipo_documento',50)->nullable();
            $table->string('documento', 50)->nullable();
            $table->string('codigo_postal',10)->nullable();
            $table->string('direccion',100)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('genero',10)->nullable();
            $table->string('telefono_fijo',11)->nullable();
            $table->string('telefono_movil',11)->nullable();
            $table->string('pais',100)->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

             /*
            |=================
            |Llaves Foraneas |
            |=================
            */
            
            $table->foreign('user_id')->references('id')->on('onlines')->onDelete('cascade');

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
