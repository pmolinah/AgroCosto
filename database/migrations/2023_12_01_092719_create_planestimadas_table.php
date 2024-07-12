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
        Schema::create('planestimadas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('planificacionEstimada');
            $table->date('fechaInicio');
            $table->date('fechaFinal');
            $table->integer('cumplida')->nullable();
            $table->float('cantidad');
            $table->bigInteger('especie_id')->unsigned();
            $table->foreign('especie_id')->references('id')->on('especies');
            $table->bigInteger('responsable_id')->unsigned();
            $table->foreign('responsable_id')->references('id')->on('users');
            $table->bigInteger('campo_id')->unsigned();
            $table->foreign('campo_id')->references('id')->on('campos');
            $table->bigInteger('cuartel_id')->unsigned();
            $table->foreign('cuartel_id')->references('id')->on('cuartels');
            $table->float('KilosActuales')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planestimadas');
    }
};
