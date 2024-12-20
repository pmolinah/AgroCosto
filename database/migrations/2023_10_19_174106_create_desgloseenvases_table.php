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
        Schema::create('desgloseenvases', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('guia_id')->unsigned();
            $table->foreign('guia_id')->references('id')->on('guias');
            $table->bigInteger('planificacioncosecha_id')->unsigned();
            $table->foreign('planificacioncosecha_id')->references('id')->on('planificacioncosechas');
            $table->integer('stock')->unsigned();
            $table->string('tarjaEnvase',20)->nullable();
            $table->bigInteger('exportadoraxplanificacion_id')->unsigned();
            $table->foreign('exportadoraxplanificacion_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desgloseenvases');
    }
};
