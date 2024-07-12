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
        Schema::create('guiarecepciondetalles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('guiarecepcion_id')->unsigned();
            $table->foreign('guiarecepcion_id')->references('id')->on('guiarecepcions');
            $table->integer('cantidadEnvase')->unsigned();
            $table->bigInteger('envase_id')->unsigned();
            $table->foreign('envase_id')->references('id')->on('envases');
            $table->bigInteger('color_id')->unsigned();
            $table->foreign('color_id')->references('id')->on('colors');
            // $table->integer('observacion')->unsigned();
            $table->bigInteger('especie_id')->unsigned();
            $table->foreign('especie_id')->references('id')->on('especies');
            $table->float('kilos')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guiarecepciondetalles');
    }
};
