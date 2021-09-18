<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accions', function (Blueprint $table) {
            $table->id();
            $table->text('comentario');
            $table->string('tipo');
            $table->date('vencimiento');
            $table->string('estado');
            $table->unsignedBigInteger('ref_tema');
            $table->unsignedBigInteger('ref_asistente');
            $table->foreign('ref_tema')->references('id')->on('temas')->onDelete('cascade');
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
        Schema::dropIfExists('accions');
    }
}
