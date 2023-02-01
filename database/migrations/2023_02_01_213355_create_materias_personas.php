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
        Schema::create('materias_personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('activo')->default(true);

            $table->string('persona_id');
            $table->foreign('persona_id')->references('documento')->on('personas')->onDelete('cascade');

            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
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
        Schema::table('materias_personas', function (Blueprint $table) {
            Schema::dropIfExists('materias_personas');
        });
    }
};
