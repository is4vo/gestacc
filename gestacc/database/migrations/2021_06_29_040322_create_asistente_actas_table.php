<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenteActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistente_actas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_acta');
            $table->unsignedBigInteger('ref_asistente');
            $table->foreign('ref_acta')->references('id')->on('actas')->onDelete('cascade');
            $table->foreign('ref_asistente')->references('id')->on('asistentes')->onDelete('cascade');
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
        Schema::dropIfExists('asistente_actas');
    }
}
