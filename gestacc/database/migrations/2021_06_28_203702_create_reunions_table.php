<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReunionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reunions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numero_reunion');
            $table->string('tipo_reunion');
            $table->date('fecha_reunion');
            $table->time('hora_inicio');
            $table->time('hora_termino');
            $table->string('estado')->default('Pendiente');
            $table->unsignedBigInteger('ref_usuario');
            $table->foreign('ref_usuario')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('reunions');
    }
}
