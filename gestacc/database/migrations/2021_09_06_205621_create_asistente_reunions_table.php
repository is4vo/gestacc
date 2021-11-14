<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenteReunionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistente_reunions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_reunion');
            $table->foreign('ref_reunion')->references('id')->on('reunions')->onDelete('cascade');
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
        Schema::dropIfExists('asistente_reunions');
    }
}
