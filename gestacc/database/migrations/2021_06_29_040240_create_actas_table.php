<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_reunion');
            $table->string('tipo_reunion');
            $table->date('fecha_reunion');
            $table->time('hora_inicio');
            $table->time('hora_termino');
            $table->string('estado')->default('Pendiente');
            $table->unsignedBigInteger('ref_usuario');
            $table->unsignedBigInteger('ref_reunion');
            $table->foreign('ref_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ref_reunion')->references('id')->on('reunions')->onDelete('cascade');
            $table->unique(['numero_reunion', 'tipo_reunion']);
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
        Schema::dropIfExists('actas');
    }
}
