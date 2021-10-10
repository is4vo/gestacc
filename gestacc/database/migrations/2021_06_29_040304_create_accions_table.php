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
            $table->string('titulo');
            $table->text('comentario')->nullable();
            $table->string('tipo');
            $table->date('vencimiento')->nullable();
            $table->string('estado')->nullable();
            $table->unsignedBigInteger('ref_tema');
            $table->unsignedBigInteger('ref_usuario')->nullable();
            $table->foreign('ref_tema')->references('id')->on('temas')->onDelete('cascade');
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
        Schema::dropIfExists('accions');
    }
}
