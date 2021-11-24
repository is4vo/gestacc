<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAprobacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aprobacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_miembro');
            $table->unsignedBigInteger('ref_acta');
            $table->foreign('ref_miembro')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ref_acta')->references('id')->on('actas')->onDelete('cascade');
            $table->boolean('aprueba')->default(0);
            $table->unique(['ref_miembro', 'ref_acta']);
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
        Schema::dropIfExists('aprobacion');
    }
}
