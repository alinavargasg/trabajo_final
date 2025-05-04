<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Libros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('libros', function(Blueprint $table){
            $table->id();
            $table->string('titulo');
            $table->string('codigo');
            $table->foreignId('autor_id'); //id del autor del libro
            $table->char('estado', 1)->default('1');
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
        Schema::dropDatabaseIfExists('libros');
    }
}
