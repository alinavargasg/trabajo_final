<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prestamos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function(Blueprint $table){
            $table->id();
            $table->dateTime('fecha_prestamo');            
            $table->foreignId('libro_id'); //id del libro a prestar
            $table->foreignId('encargado_id'); //id del usuario bibliotecario a cargo del préstamo
            $table->foreignId('lector_id'); //id del usuario lector que se está prestando el libro
            $table->char('estado',1)->default('1');
            $table->dateTime('fecha_devolucion_programada')->default(null);            
            $table->dateTime('fecha_devolucion_real')->default(null);
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
        Schema::dropDatabaseIfExists('prestamos');
    }
}
