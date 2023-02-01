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
        Schema::create('personas', function (Blueprint $table) {     
            $table->string('documento', 20)->primary();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            
            $table->enum('tipo', ['STUDENT', 'DOCENTE'])->default('STUDENT');
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
        Schema::table('personas', function (Blueprint $table) {
            Schema::dropIfExists('personas');
        });
    }
};
