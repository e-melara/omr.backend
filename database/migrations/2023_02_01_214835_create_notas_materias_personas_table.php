<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas_materias_personas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('materia_persona_id');
            $table->foreign('materia_persona_id')->references('id')->on('materias_personas')->onDelete('cascade');

            $table->unsignedBigInteger('nota_id');
            $table->foreign('nota_id')->references('id')->on('notas')->onDelete('cascade');
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
        Schema::table('notas_materias_personas', function (Blueprint $table) {
            //
        });
    }
};
