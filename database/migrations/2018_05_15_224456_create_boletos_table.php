<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primerNombre',50);
            $table->string('segundoNombre',50);
            $table->string('apellido',50);
            $table->enum('genero',['masculino','femenino']);
            $table->date('fecha_nacimiento');
            $table->string('tipo_documento',50)->nullable();
            $table->string('documento',50);
            $table->enum('boleto_estado',['Reservado','Pagado','Chequeado','Cancelado','Temporal'])->default('Reservado');
            $table->date('fecha_expiracion')->nullable();
            $table->enum('tipo_boleto',['adulto','niño','bebe en brazos']);
            $table->string('asiento',50);
            $table->boolean('checkin')->default(false);
            $table->string('localizador',50);
            $table->integer('user_id')->unsigned();
            $table->integer('factura_id')->unsigned();
            $table->integer('vuelo_id')->unsigned();
            
            $table->timestamps();

            /*
            |=================
            |Llaves Foraneas |
            |=================
            */

            $table->foreign('user_id')->references('id')->on('onlines')->onDelete('cascade');
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
            $table->foreign('vuelo_id')->references('id')->on('vuelos')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boletos');
    }
}
