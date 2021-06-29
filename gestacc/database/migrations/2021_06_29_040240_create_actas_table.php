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
            $table->string('numero_reunion')->unique();
            // $table->foreign('ref_reunion')->references('id')->on('reuniones')->onDelete('cascade');
            $table->string('tipo_reunion');
            $table->date('fecha_reunion');
            $table->string('hora_inicio');
            $table->string('hora_termino');
            $table->boolean('cerrada');
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
