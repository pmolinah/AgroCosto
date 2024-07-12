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
        Schema::create('detalleguias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('guia_id')->unsigned();
            $table->foreign('guia_id')->references('id')->on('guias');
            $table->bigInteger('planificacioncosecha_id')->unsigned();
            $table->foreign('planificacioncosecha_id')->references('id')->on('planificacioncosechas');
            $table->integer('cantidadEnvases')->nullable();
            $table->string('detalle')->nullable();
            $table->bigInteger('color_id')->unsigned();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->string('observacion',100)->nullable();
            $table->bigInteger('especie_id')->unsigned();
            $table->foreign('especie_id')->references('id')->on('especies');
            $table->integer('kilos')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleguias');
    }
};
