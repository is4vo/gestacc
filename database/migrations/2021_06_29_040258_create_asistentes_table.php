<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_usuario');
            $table->unsignedBigInteger('ref_acta');
            $table->foreign('ref_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ref_acta')->references('id')->on('actas')->onDelete('cascade');
            $table->boolean('asiste');
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
        Schema::dropIfExists('asistentes');
    }
}
