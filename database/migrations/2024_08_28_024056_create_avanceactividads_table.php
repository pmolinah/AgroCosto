<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('avanceactividads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('actividad_id')->unsigned();
            $table->foreign('actividad_id')->references('id')->on('actividads');
            $table->bigInteger('costoactividad_id')->unsigned();
            $table->foreign('costoactividad_id')->references('id')->on('costoactividads');
            $table->float('ejecutado');
            $table->float('restante');
            $table->date('fechaAvance')->nullable();
            $table->integer('valor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avanceactividads');
    }
};
